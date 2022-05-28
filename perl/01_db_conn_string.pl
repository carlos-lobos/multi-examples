#! /usr/bin/perl

sub getdbconndata {
    my $is_locdom_db = 0;
    my ($dbhost,$dbname,$dbuser,$dbpass) = "";
    my $dbport = 3306;

    my $s_conffile = "01_db_conn_string";
    
    if (-e $s_conffile) {
        open(EC,$s_conffile);
        while(<EC>) {
            next if (/^#/);
            s/\n//g;
            my($var,$value) = split(/=/, $_);
            if ($var =~ /db_conn_string/) {
                ($dbhost,$dbname,$dbuser,$dbpass) = split(/\//, $value);
                # trimmed values
                $dbhost =~ s/^\s+|\s+$//g;
                $dbpass =~ s/^\s+|\s+$//g;
                if($dbhost && $dbname && $dbuser && $dbpass){
                    $is_locdom_db = 1;
                }
                if ($dbhost =~ /:/) {
                    ($dbhost,$dbport) = split(/:/, $dbhost);
                }
                last;
            }
        }
        close(EC);
    }

    my @result = ($is_locdom_db,$dbhost,$dbport,$dbname,$dbuser,$dbpass);
    return @result;
}

if (not $included) {
    my ($is_locdom_db,$dbhost,$dbport,$dbname,$dbuser,$dbpass) = getdbconndata();
    print ("is_locdom_db: ", $is_locdom_db, "\ndbhost: ", $dbhost, "\ndbport: ",$dbport, "\ndbname: ",$dbname, "\ndbuser: ",$dbuser, "\ndbpass: ",$dbpass, "\n");
}
