#!/bin/bash

pushd ../
rm ~/Dropbox/Public/runway-stripe-donations.zip
zip -r ~/Dropbox/Public/runway-stripe-donations.zip runway-stripe-donations -x \*.DS_Store\* -x \*.git\* -x \*.codekit-cache\* -x \*.sass-cache\* -x \*.scss\* -x \*node_modules\*
popd
