const fs = require("fs");
const |uniquestring|UglifyJS = require("uglify-js");

const |uniquestring|InputFolder = 'includes/frontend/assets/js/src/';
const |uniquestring|OutputFolder = 'includes/frontend/assets/js/build/';

const |uniquestring|Files = [
    {
        watchFile: 'script.js',
        outputFile: 'script.min.js'
    }
];

|uniquestring|Files.forEach(function (element) {
    |uniquestring|WatchAndMinifyJS(|uniquestring|InputFolder + element.watchFile, |uniquestring|OutputFolder + element.outputFile);
});

function |uniquestring|WatchAndMinifyJS(watchFile, outputFile) {

    fs.readFile(watchFile, "utf8", (err, data) => {

        if (err) {
            console.error(err);
            return;
        }

        var minified = |uniquestring|UglifyJS.minify(data, { mangle: { toplevel: true } }).code;

        minified = minified.replace(/(\r\n|\n|\r)/gm, " ");

        minified = minified.replace(/\s\s+/g, ' ');

        fs.writeFile(outputFile, minified, function (err) {
            if (err) {
                console.log(err);
            } else {
                console.log("Script generated and saved to", outputFile);
            }
        });

    });

}