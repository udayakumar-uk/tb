if {[info exists bramchat]} {#killtimer $bramchat(timerid)
                             unset bramchat}

# waktu untuk mengechek channels setelah diam. dalam (detik)
set bramchat(timer) 10

# Bot ngomong pada waktu channel diam brapa detik
# sebagai contoh: 600 untuk 10min dan 1200 untuk 20min
set bramchat(bramtime) 180

# Respon Bot pada Channel, jika lebih dari satu channel, pisahkan dengan spasi.
set bramchat(chans) "#GembelZ"

# Abaikan Nick ketika ada random nick
set bramchat(bots) "Virgin Virgin Virgin"

set bramchat(ver) "v1.00"

# "ISI PESAN" Anda dapat mengisi pesan terserah anda di bawah ini
set bramchat(comments) {
 {wew, celana dalemnye warna gelap... lha kok makin lama makin gelap yee..?}
 {ahh.. Nyari-nyari cewe doeloe akh}
 {cewe2.. godain DurjanA donk}
 {yang mau jadi OP minta sama bos aye, siapa lagi klo bukan DurjanA yang makin lama makin Caem aje ..}
 {akh elo.. bisanye cuma minta tolong aje}
 {!seen DurjanA}
 {anak mane sih tuh? konyol banget.. asyuuu}
 {mendingan lo pade maen quiz aje, dari pade ngegosip}
 {iyut, uny_ di cariin tuh ama COWOK_KEREN...}
 {channel GembelZ memang yahuudddd}
 {bos gw DurjanA lagi sibuk kali yee..sibuk..sibuk..sibuk truz ampe tuntaz }
 {wow, ada Mister Gele}
 {sini lo, gw cipok nih? hehehehe... becanda bro?}
 {dasar.... homo}
 {ngaji ah... alifff lammmmm mimmmm..}
 {cari gebatan ....mantab dakh}
 {ahh mending tidur aje.. daripade denger lo curhat.. zzzzzzZZZZZZ}
 {uhukss...test...tist...}
 {channel ko sepi yee ... ada nye bot doank yang ngoceh...}
 {iyut oh..uny_..oh..Blue_KeyLa..mana yah...:P}
 {serrrr...serrrr...serrrr...serrrr...lembut belaian tanganmu...}
 {cuci tangan cuci kaki cuci muka langsung kentudd.. tud.. tud..}
 {Jalan terbaik untuk menjaga persahabatanmu tetap HIDUP adalah dengan MENGUBUR kesalahan teman2mu...}
 {Betapa istimewa rasanya, menCINTAi seseorang dengan sungguh2 & tidak menuntut apa2 dari perasaan itu. Cukup dengan merasakannya dan menghargai apa adanya......}
 {Cinta boleh hancur... Kemauan boleh tak terwujud. Tapi... putus asa tak boleh ada. Bangkit dan terus berjuang...demi kehidupan panjang di hari esok....}
 {Ngomong...oiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii...kaya kuburan sepiiiiiiii}
 {mo cari DurjanA, langkahin dulu mayat gw...}
 {duhhhh, pengin merasakan lagi nikmatnya bercinta :P}
 {Sepi.Sepi.Sepi.Sepi.Sepi.Sepi.Sepi.Sepi}
 {Brb ah BT ngoceh sendirian...}
 {COWOK_KEREN memang KEREN.. tapi itu katanye sendiri loh..}
 {Akeah, so datang poli orang mo ba tagi juew... basambunyi duluw ahk :P~~~}
 {Biarkan Bintang Menari... oups, itu Bintang ape penari balet.. ko menari-nari!!}
                       } 

proc randomline {text} {
 return [lindex $text [rand [llength $text]]]
}

proc check_bramchat {} {
global bramchat

set chans [string tolower [channels]]
foreach c $chans {
 if {[info exists bramchat($c)]} {

 set dochan 999
 foreach chans [string tolower $bramchat(chans)] {
  if {$c == $chans} {set dochan 1}
                                                 }

   if {($dochan == 1) && ([expr [unixtime] - $bramchat($c)] > $bramchat(bramtime))} {
                                                set outmsg [randomline $bramchat(comments)]
                                                set user [rnduser $c]
                                                regsub -all {\$nick} $outmsg $user outmsg
                                                regsub -all {\\001} $outmsg \001 outmsg
                                                regsub -all {\\002} $outmsg \002 outmsg
                                                putserv "privmsg $c :$outmsg"
                                                set bramchat($c) [unixtime]
                                               }
                                 }
 if {![info exists bramchat($c)]} {set bramchat($c) [unixtime]}
                                        
                 }
set bramchat(timerid) [timer $bramchat(timer) check_bramchat]
}
set bramchat(timerid) [timer $bramchat(timer) check_bramchat]

proc rnduser {chan} {
global botnick bramchat
 set clist [chanlist $chan]
 if {([llength $clist] == 1)} {set clist "$clist her"}
 set pickeduser 0
while {$pickeduser == 0} {
                          set user [lindex $clist [rand [llength $clist]]]
                          set pickeduser 1

    foreach n $bramchat(bots) {
     if {([string tolower $user] == [string tolower $n])} {set pickeduser 0}
                              }

                         }
 set uhand [nick2hand $user $chan]
 return $user
}


bind pubm - "**" pub_bramchat_set
proc pub_bramchat_set {nick uhost hand chan rest} {
global bramchat
 if {([matchattr $hand b] != 0)} {return 0}
 set bramchat([string tolower $chan]) [unixtime]
 return 0
 }

bind ctcp - ACTION action_bramchat_set
proc action_bramchat_set {nick uhost hand chan key text} {
global bramchat
 if {([matchattr $hand b] != 0)} {return 0}
 set bramchat([string tolower $chan]) [unixtime]
 return 0
}

return "No Idle Chan $bramchat(ver) by DurjanA Loaded :-"

