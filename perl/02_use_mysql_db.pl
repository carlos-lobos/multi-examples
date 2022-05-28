#! /usr/bin/perl

# This example use DBI Perl Module
# For exec in ubuntu or similar distribution install this
#     sudo apt-get install libclass-dbi-mysql-perl

BEGIN {
    push(@INC,".");
}

if (-e "01_db_conn_string.pl") {
    $included = 1;
    do "01_db_conn_string.pl";
}

sub getallusers {
    my ($is_locdom_db,$dbhost,$dbport,$dbname,$dbuser,$dbpass) = getdbconndata();
    my @USERS;

    if ($is_locdom_db) {
        use DBI;

        my $s_dsn= "dbi:mysql:database=$dbname;host=$dbhost;port=$dbport";
        my $dbh = DBI->connect(
            $s_dsn,
            $dbuser,
            $dbpass,
            { RaiseError => 0, PrintError => 1 },
        );

        if ($dbh) {
            my $s_sql = "SELECT username FROM users ORDER BY username";

            my $sth = $dbh->prepare($s_sql);
            $sth->execute();

            while (my $row = $sth->fetchrow_arrayref()) {
                push @USERS, @$row[0];
            }

            $sth->finish();
            $dbh->disconnect();
        }
    }

    return @USERS;
}

my @USERS = getallusers();

print("Users List:\n");
print("-----------\n");
foreach my $user (@USERS) {
    print($user, "\n");
}
