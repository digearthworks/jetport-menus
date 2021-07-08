#!/bin/bash
find ./${3} \( -type d -name .git -prune \) -o -type f -print0 | xargs -0 sed -i "s/${1}/${2}/g"