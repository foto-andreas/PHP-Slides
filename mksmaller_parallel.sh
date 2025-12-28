#!/bin/bash

mkdir -p images
if [[ "$*" == --replace ]]; then
  rm -f images/*
fi

ls -1 images_o/*.{jpg,jpeg,png,JPG,JPEG,PNG} 2>/dev/null | xargs -P 6 -I @ ./image2048.sh @
#ls -1 images_o/*.{mp4,MP4,mov,MOV} 2>/dev/null | xargs -P 6 -I @ ./video.sh @
