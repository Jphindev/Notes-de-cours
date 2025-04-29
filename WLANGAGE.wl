//////////////
// WLANGAGE //
//////////////

// -> programmation événementielle

// Syntaxe classique
TableAjouteLigne(TABLE_TableProduit, "Dubois", "Pierre")

// Syntaxe préfixée
TABLE_TableProduit.AjouteLigne("Dubois", "Pierre")

// Pour tester une manipulation (comme console.log)
SI EnModeTest() = Vrai ALORS //
  Trace("Variable NumMenu : " + NumMenu)
FIN
