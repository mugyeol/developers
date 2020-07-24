
/*
 * Check if this browser support SVG and createDocument()
 */
var supportsSVG = function () {
    // if it doesn't support createDocument()
    // it must be IE 8, this dude doesnt support SVG anyway
    return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") &&
        document.implementation.createDocument;
};

/*
 * Cache register for all the sources
 */
let _srcCache = {};

let _loadingCallback = {};

/*
 * Load 
 */
var makeAjaxRequest = function (file, cb) {
    let x = new (XMLHttpRequest || ActiveXObject)('MSXML2.XMLHTTP.3.0');
    x.open('GET', file, 1);
    //
    x.onreadystatechange = function () {
        if (x.readyState > 3) {
            if (x.status < 400) {
                cb(x.responseText);
            } else {
                cb(null);
            }
        }
        return;
    };
    x.send();
    return file;
};


/*
 * Create an alternative document object
 * @param content -  String
 */
var createDoc = function (content) { 
    let srcDoc = document.implementation.createHTMLDocument(
        'http://www.w3.org/1999/xhtml', 
        'html', 
        null
    );
    
    var body        = srcDoc.createElement("body");
    body.innerHTML  = content;

    srcDoc.documentElement.appendChild(body);
    return srcDoc;
};


/*
 * Make a HTTP request for a file if needs to.
 * Return a document object
 * @param file - string
 * @param cb - function
 */
var loadSrc = function (file, cb) {
    
    var callCallback = function (doc) {
        var cb;
        while (cb = _loadingCallback[file].shift()) {
            cb(doc);
        }
    };

    var doLoad = function () {
        if (!_loadingCallback[file]) {
            _loadingCallback[file] = [];

            makeAjaxRequest(file, function (content) {
                if (content) {
                    let doc = createDoc(content);
                    _srcCache[file] = doc;
                    callCallback(doc);
                } else {
                    callCallback(null);
                }
            });
        }
        
        _loadingCallback[file].push(cb); 
    };

    return _srcCache[file] ? cb(_srcCache[file]) : doLoad(); 
};

/*
 * Recursively import nodes from an element to another
 * This exists because IE9 and below doesnt support innerHTML on SVGElement
 */
var importNodes = function (orig, dest) {
    for (let i = 0; i < orig.childNodes.length; i++) {  
        dest.appendChild(
            orig.childNodes[i].cloneNode(true) 
        );
    };
    return dest;
};

/*
 * Create a SVG element
 * @param element - the original SVG element
 */
var createSvgElement = function (element) {
    let svg = importNodes(
        element, 
        document.createElementNS("http://www.w3.org/2000/svg", "svg")
    ); 
    
    // assign viewBox
    if (element.getAttribute("viewBox")) {
        svg.setAttribute("viewBox", element.getAttribute("viewBox"));
    }
    
    // namespace and stuff
    svg.setAttribute("xmlns", 
        element.getAttribute("xmlns") ? 
            element.getAttribute("xmlns") : 
            "http://www.w3.org/2000/svg"
    );

    svg.setAttribute("version", 
        element.getAttribute("version") ? 
            element.getAttribute("version") : 
            "1.1"
    );

    return svg;
};


/*
 * Picks an icon source, fallbacks to other if one fails
 *
 * @param srcs - Array of source URL
 * @param callback - A callback function
 */
export default function (srcs, callback) {
    var isSvg = function (url) {
        let parts = url.split("#");
        return /\.svg/.test(parts[0]);
    };

    var innerPicker = function (c) {
        if (c >= srcs.length) {
            return void(0);
        }
        
        //
        let nex             = c + 1;
        let src             = srcs[c];
        let isSvgSupported  = supportsSVG();

        if (isSvg(src)) {
            if (!isSvgSupported) {
                return innerPicker(nex);
            } else {
                let parts   = src.split("#");
                let anchor  = parts[1];
                return loadSrc(parts[0], function (doc) {
                    if (doc) {
                        var ele;
                        
                        // check if the anchor matches any element in the document
                        // if not, then move on
                        if (anchor) {
                            ele = doc.getElementById(anchor);
                            
                            if (!ele) {
                                return innerPicker(nex);
                            }
                        }

                        return callback(
                            createSvgElement(
                                anchor                      ? 
                                ele                         : 
                                doc.getElementsByTagName("svg")[0]
                            )
                        );
                    }
                    return innerPicker(nex);
                });
            }
        } else {
            let img     = document.createElement("img");
            img.src     = src;
            img.onerror = function () {
                innerPicker(nex);
            };

            img.onload = function () {
                callback(this);
            };
            return;
        }
    };
    
    // start the loop
    innerPicker(0);
};

