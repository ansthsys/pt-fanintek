/**
 *  Hitunglah jumlah pasang kaos kaki yang dapat dijual oleh sales.
 *  Contoh:
 *    Input: [5, 7, 7, 9, 10, 4, 5, 10, 6, 5]
 *    Output: 3
 *  Keterangan: Hanya 3 pasang kaos kaki yang dapat dijual (5, 7, 10)
 *
 *  Soal:
 *    a. Input: [10 20 20 10 10 30 50 10 20]
 *       Output yang diharapkan: 3
 *    b. Input: [6 5 2 3 5 2 2 1 1 5 1 3 3 3 5]
 *       Output yang diharapkan: 6
 *    c. Input: [1 1 3 1 2 1 3 3 3 3]
 *       Output yang diharapkan: 4
 */

// function
const totalPairs = (arr) => {
  const obj = {};
  let totalPairs = 0;

  arr.forEach((i) => (obj[i] = (obj[i] || 0) + 1));
  for (const key in obj) totalPairs += Math.floor(obj[key] / 2);

  return totalPairs;
};

// Soal
const inputA = [10, 20, 20, 10, 10, 30, 50, 10, 20];
const inputB = [6, 5, 2, 3, 5, 2, 2, 1, 1, 5, 1, 3, 3, 3, 5];
const inputC = [1, 1, 3, 1, 2, 1, 3, 3, 3, 3];

// Output
console.log(`Output Soal A: ${totalPairs(inputA)}`);
console.log(`Output Soal B: ${totalPairs(inputB)}`);
console.log(`Output Soal C: ${totalPairs(inputC)}`);
