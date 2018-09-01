# !/usr/bin/perl -w

if ((scalar @ARGV) != 3) {
    print "program x y density \n";
    exit;
}

open (MAP, ">map.txt") || die("The file 'map.txt' does not exists");

my $x = $ARGV[0];
my $y = $ARGV[1];
my $density = $ARGV[2];
my $i = 0;
my $j = 0;

print MAP $y . "\n";

while ($i < $y) {
    $j = 0;

    while ($j < $x) {
        if (int(rand($y) * 2) < $density) {
            print MAP "o";
        } else {
            print MAP ".";
        }

        $j++;
    }

    if ($i + 1 != $y) {
    	print MAP "\n";
	}

    $i++;
}

close (MAP);