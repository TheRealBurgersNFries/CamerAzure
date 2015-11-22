#!/bin/bash
curl --trace-ascii -iv -X POST \
-H "Authorization: CloudSight QjfN3AYDZsxYRgOSx9ldWQ" \
-F "image_request[remote_image_url]=http://fitnessheat.com/wp-content/uploads/2014/10/tomato-nutrition-facts.jpg" \
-F "image_request[locale]=en-US" \
https://api.cloudsightapi.com/image_requests
