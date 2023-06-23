/**
 *  Hitunglah jumlah kata pada sebuah kalimat.
 *  Contoh:
 *    Input: Kemarin Shopia per[gi ke mall.
 *    Output: 4 (Karena kata pergi memiliki special karakter)
 *
 *  Soal:
 *    a. Input: Saat meng*ecat tembok, Agung dib_antu oleh Raihan.
 *       Output: 5
 *    b. Input: Berapa u(mur minimal[ untuk !mengurus ktp?
 *       Output: 3
 *    c. Input: Masing-masing anak mendap(atkan uang jajan ya=ng be&rbeda.
 *       Output: 4
 */

// function
const countWord = (str) => {
  const regex = new RegExp("[*_()[\\]!=&]+", "gm");
  const strSplit = str.split(" ");
  const strClean = strSplit.filter((item) => !item.match(regex));

  return strClean.length;
};

// Soal
const inputA = "Saat meng*ecat tembok, Agung dib_antu oleh Raihan.";
const inputB = "Berapa u(mur minimal[ untuk !mengurus ktp?";
const inputC = "Masing-masing anak mendap(atkan uang jajan ya=ng be&rbeda.";

// Output
console.log(`Output Soal A: ${countWord(inputA)}`);
console.log(`Output Soal B: ${countWord(inputB)}`);
console.log(`Output Soal C: ${countWord(inputC)}`);
