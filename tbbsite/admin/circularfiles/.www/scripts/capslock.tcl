#########################
##  Proteksi CapsLock  ##
#########################

bind pubm - * caps_pubm
bind notc - * caps_pubm
bind ctcp - ACTION caps_pubm
proc caps_pubm {nick uhost hand chan text} {
  if [matchattr $hand f] {return 0}
  set upper 0
  foreach i [split $text {}] {
    if [string match \[A-Z\] $i] {
      incr upper
    }
}
  if {$upper == 0} {
  return 0
}
  if {[string length $text] < 20} {return 0}
  set capchar [string length $text]
  set number $upper/$capchar
  if {[expr 30 * $upper / $capchar] > 20} {
  putserv "KICK $chan $nick :Wuih Biar Nda Pke Caps Olo debo mo dpa baca utisss"
  }
}
