// var enTable = document.getElementById('enTable'),
//     arTable = document.getElementById('arTable'),

//     enTableRows = enTable.rows.length - 2, // 2 here stands for head and footer
//     arTableRows = arTable.rows.length - 2, // 2 here stands for head and footer

//     enData = [ // delete this and get data from API
//         [
//         serialNumber = 1,
//         description = 'Principle of flow cytometry and its uses',
//         priceBeforeDiscount = '180.00 SAR',
//         discount = '10%',
//         priceAfterDiscount = '160.00 SAR',
//         No = 1,
//         total = '160.00 SAR'
//         ],
//         [
//         serialNumber = 1,
//         description = 'Principle of flow cytometry and its uses',
//         priceBeforeDiscount = '180.00 SAR',
//         discount = '10%',
//         priceAfterDiscount = '160.00 SAR',
//         No = 1,
//         total = '160.00 SAR'
//         ]
//     ],

//     arData = [ // delete this and get data from API
//         [
//         serialNumber = 1,
//         description = 'مبدأ عمل التدفق الخلوي و أستخدمات',
//         priceBeforeDiscount = '180.00 SAR',
//         discount = '10%',
//         priceAfterDiscount = '160.00 SAR',
//         No = 1,
//         total = '160.00 SAR'
//         ],
//         [
//         serialNumber = 1,
//         description = 'مبدأ عمل التدفق الخلوي و أستخدماته',
//         priceBeforeDiscount = '180.00 SAR',
//         discount = '10%',
//         priceAfterDiscount = '160.00 SAR',
//         No = 1,
//         total = '160.00 SAR'
//         ]
//     ],

//     enDataCount = enData.length,
//     enDataColumns = 7, // we only need 6 columns from data so far.... only change this when customer wants to

//     arDataCount = arData.length,
//     arDataColumns = 7; // we only need 6 columns from data so far.... only change this when customer wants to



// for ( i=0 ; i < enDataCount ; i++ ) {
//     var row = enTable.insertRow(i+1);
//     for ( j=0 ; j < enDataColumns ; j++ ){
//         var cell = row.insertCell(j);
//         cell.innerHTML = enData[i][j];
//     }
// }

// for ( i=0 ; i < arDataCount ; i++ ) {
//     var row = arTable.insertRow(i+1);
//     for ( j=0 ; j < arDataColumns ; j++ ){
//         var cell = row.insertCell(j);
//         cell.innerHTML = arData[i][j];
//     }
// }
