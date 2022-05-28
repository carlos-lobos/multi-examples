#!/bin/bash

# tlds-alpha-by-domain.txt => List of Top Level Domains
# wget https://data.iana.org/TLD/tlds-alpha-by-domain.txt

# 1) Copy a file directly Gzipped
php cpgz.php tlds-alpha-by-domain.txt tlds-alpha-by-domain.txt.gz

# 2) Copy a gzipped file to ungzipped destiny
php cpgz.php tlds-alpha-by-domain.txt.gz tlds-alpha-by-domain-ungzipped.txt
