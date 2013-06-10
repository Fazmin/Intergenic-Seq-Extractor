#!/usr/bin/env python
import sys
import Bio
from Bio import SeqIO, SeqFeature
from Bio.SeqRecord import SeqRecord
import os
 
def fetch_intg(genbank_path,intergene_length=1,typedo='CDS',intergene_length_h=1000):
    seq_record = SeqIO.parse(open(genbank_path), "genbank").next()
    cds_list_plus = []
    cds_list_minus = []
    intergenic_records = []
    # typedo = 'gene'
    # Loop over the genome file, get the CDS features on each of the strands
    for locus in seq_record.features:
        fullen = len(seq_record.seq)

    for feature in seq_record.features:
        if feature.type == typedo:
        # if feature.type == 'CDS':
            mystart = feature.location._start.position
            myend = feature.location._end.position
            if feature.strand == -1:
                cds_list_minus.append((mystart,myend,-1))
            elif feature.strand == 1:
                cds_list_plus.append((mystart,myend,1))
            else:
                sys.stderr.write("No strand indicated %d-%d. Assuming +\n" %
                                  (mystart, myend))
                cds_list_plus.append((mystart,myend,1))
 
    for i,pospair in enumerate(cds_list_plus[1:]):
        # Compare current start position to previous end position
        last_end = cds_list_plus[i][1]
        this_start = pospair[0]
        strand = pospair[2]
        between = abs(last_end - this_start)
        if (this_start - last_end >= intergene_length) and (this_start - last_end <= intergene_length_h):
            intergene_seq = seq_record.seq[last_end:this_start]
            strand_string = "+"
            test_string = "UpSt"
            intergenic_records.append(
                  SeqRecord(intergene_seq,id="%s-ig-%d" % (seq_record.name,i),
                  description="%s %d-%d %s %s %d" % (seq_record.name, last_end+1,
                                                        this_start,strand_string, test_string, between)))
    for i,pospair in enumerate(cds_list_minus[1:]):
        last_end = cds_list_minus[i][1]
        this_start = pospair[0]
        strand = pospair[2]
        between = abs(last_end - this_start)
        if (this_start - last_end >= intergene_length) and (this_start - last_end <= intergene_length_h,):
            intergene_seq = seq_record.seq[last_end:this_start]
            strand_string = "-"
            test_string = "DownSt"
            intergenic_records.append(
                  SeqRecord(intergene_seq,id="%s-ig-%d" % (seq_record.name,i),
                  description="%s %d-%d %s %s %d" % (seq_record.name, last_end+1,
                                                        this_start,strand_string, test_string, between)))
    outpath = os.path.splitext(os.path.basename(genbank_path))[0] + "_ign_"+typedo+".fasta"
    SeqIO.write(intergenic_records, open(outpath,"w"), "fasta")
 
if __name__ == '__main__':
    if len(sys.argv) == 2:
         fetch_intg(sys.argv[1])
    elif len(sys.argv) == 3:
         fetch_intg(sys.argv[1],int(sys.argv[2]))
    elif len(sys.argv) == 4:
         fetch_intg(sys.argv[1],int(sys.argv[2]),sys.argv[3])
    elif len(sys.argv) == 5:
         fetch_intg(sys.argv[1],int(sys.argv[2]),sys.argv[3],int(sys.argv[4]))
    else:
         print "Usage: get_intergenic.py gb_file [intergenic length] [CDS or gene] [max length]"
         sys.exit(0)