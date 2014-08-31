#!/bin/bash
cd "$( dirname "$0" )"
while true
do
    DATE=$(date +%Y-%m-%d-%H%M%S)
    DATEDIR=$(date +%Y-%m-%d)
    echo "| ==========================================================="
    echo "| ================] taking the picture ... [================="
    fswebcam -r 1280x960 -q --top-banner --font Arial:28 --banner-colour "#ff000000" --line-colour "#ff000000" --delay --save "cam1.jpg"
    #echo "| ====================] resizing ... [======================= |"
    convert cam1.jpg -resize 768 -quality 100 cam1_resized.jpg
    echo "| ===================] optimizing ... [======================"
    jpegoptim -m70 --strip-all cam1_resized.jpg
    echo "| ====================] uploading ... [======================"
    rsync -avz --bwlimit 20 -e "ssh -o StrictHostKeyChecking=no" --progress cam1_resized.jpg sftp@jastrow.me:/var/www/vhosts/lvps92-51-134-136.dedicated.hosteurope.de/schwerkraftlabor.de_home/tmp/
    echo "| ==================] create backup-dir [===================="
    mkdir backup/$DATEDIR
    echo "... or maybe not, because I already did so today..."
    echo "| =================] and making a backup [==================="
    cp cam1.jpg backup/$DATEDIR/cam1-$DATE.jpg
    echo "| ==========================================================="
    echo "| =======================] waiting [========================="
    echo "If you want to completely stop the webcam now,"
    echo "press Ctrl-C before the time is up!"
    echo ""
    echo "Next picture in:"
    echo ""
    for i in {1..1}
        do
            echo "$i ..."
            sleep 1
        done
    echo ""
    echo "Now!"
done
