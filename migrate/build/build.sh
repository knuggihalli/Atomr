#!/bin/sh
#
# Purloined from the OpenLayers code http://www.openlayers.org
#
INPUT_FILENAME=jquery.tagsphere.js
OUTPUT_FILENAME=jquery.tagsphere.min.js
TMP_OUTPUT_FILENAME=tmp.jquery.tagsphere.js

CMD_JSMIN=./jsmin.py

LICENSE_HEADER_FILENAME=licence.txt

echo
echo Shrinking ...
# (We also append the license header here.)
rm ../${OUTPUT_FILENAME}
cat ${LICENSE_HEADER_FILENAME} > ../${OUTPUT_FILENAME}
${CMD_JSMIN} <../${INPUT_FILENAME} >> ../${OUTPUT_FILENAME}


echo
echo Done.