
<?php
session_start();
 
require 'init.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="node_modules/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
    <script type="text/javascript" src="node_modules/tabulator-tables/dist/js/tabulator.min.js"></script>
   
    <title>Teste</title>
</head> 

        <?php if (isLoggedIn()): ?>
            <p>Olá, <?php echo $_SESSION['user_name']; ?>. <a href="panel.php">Painel</a> | <a href="logout.php">Sair</a></p>
        <?php else: ?>
            <p>Olá, visitante. <a href="login.html">Login</a></p>
        <?php endif; ?>
<body>
    <button type="submit" id="download-xlsx">XLXB</button>
    <a name="" id="download-json" class="btn btn-primary" href="#" role="button">Baixar PDF</a>
    <a name="" id="file-load-trigger" class="btn btn-alet" href="#" role="button">Upload</a>
       <div id="example-table"></div>
    <script  type="text/javascript">
    

    //var table = new Tabulator("#example-table", {});  
   var teste = [
    {id:1, name:"Billy Bob", age:12, gender:"male", height:95, col:"red", dob:"14/05/2010"},
    {id:2, name:"Jenny Jane", age:42, gender:"female", height:142, col:"blue", dob:""},
    {id:3, name:"Steve McAlistaire", age:35, gender:"male", height:176, col:"green", dob:"04/11/1982"},
];
// var table = new Tabulator("#example-table", {
//         data:teste,
//         autoColumns:true,
//     });
    //Create Date Editor
var dateEditor = function(cell, onRendered, success, cancel){
    //cell - the cell component for the editable cell
    //onRendered - function to call when the editor has been rendered
    //success - function to call to pass the successfuly updated value to Tabulator
    //cancel - function to call to abort the edit and return to a normal cell

    //create and style input
    var cellValue = moment(cell.getValue(), "DD/MM/YYYY").format("YYYY-MM-DD"),
    input = document.createElement("input");

    input.setAttribute("type", "date");

    input.style.padding = "4px";
    input.style.width = "100%";
    input.style.boxSizing = "border-box";

    input.value = cellValue;

    onRendered(function(){
        input.focus();
        input.style.height = "100%";
    });

    function onChange(){
        if(input.value != cellValue){
            success(moment(input.value, "YYYY-MM-DD").format("DD/MM/YYYY"));
        }else{
            cancel();
        }
    }

    //submit new value on blur or change
    input.addEventListener("blur", onChange);

    //submit new value on enter
    input.addEventListener("keydown", function(e){
        if(e.keyCode == 13){
            onChange();
        }

        if(e.keyCode == 27){
            cancel();
        }
    });

    return input;
};

//define table
    //Create Date Editor

    //cell - the cell component for the editable cell
    //onRendered - function to call when the editor has been rendered
    //success - function to call to pass the successfuly updated value to Tabulator
    //cancel - function to call to abort the edit and return to a normal cell

    //create and style input
    //DOWNLOAD ADASDASDASDASD
//     var table = new Tabulator("#example-table", {
//         data:teste,
//     height:"311px",
//     columns:[
//         {title:"Name", field:"name", width:200},
//         {title:"Progress", field:"progress", width:100, sorter:"number"},
//         {title:"Gender", field:"gender"},
//         {title:"Rating", field:"rating", width:80},
//         {title:"Favourite Color", field:"col"},
//         {title:"Date Of Birth", field:"dob", align:"center", sorter:"date"},
//         {title:"Driver", field:"car", align:"center", formatter:"tickCross"},
//     ],
// });
//Build Tabulator
var table = new Tabulator("#example-table", {
    height:700,
    layout:"fitColumns",
    autoColumns:true,
    placeholder:"Esperando upload do arquivo.",
});

//trigger AJAX load on "Load Data via AJAX" button click
$("#file-load-trigger").click(function(){
    table.setDataFromLocalFile();
});

//trigger download of data.csv file
$("#download-csv").click(function(){
    table.download("csv", "data.csv");
});

//trigger download of data.json file
$("#download-json").click(function(){
    table.download("json", "data.json");
});

//trigger download of data.xlsx file
$("#download-xlsx").click(function(){
    table.download("xlsx", "data.xlsx", {sheetName:"teste"});
});

//trigger download of data.pdf file
$("#download-pdf").click(function(){
    table.download("pdf", "data.pdf",  {
        orientation:"portrait", //set page orientation to portrait
        title:"Example Report", //add title to report
    });
});

    </script>
</body>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>

<table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job Title</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $data->fetch()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($r['matricula_id']) ?></td>
                    <td><?php echo htmlspecialchars($r['data_rascunho']); ?></td>
                    <td><?php echo htmlspecialchars($r['nome']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
 datarasc:"<?php echo $r['data_rascunho']; ?>", 
        // dataCerta:"<?php echo $r['newdate']; ?>"
        // area:"<?php echo $r['area']; ?>",
        // proprietarios:"<?php echo $r['proprietarios']; ?>",
        // cadImibiliario:"<?php echo $r['cad_imobiliario']; ?>",
        // onus:"<?php echo $r['onus_vigente']; ?>",
        // dataNova:"<?php echo $r['datanova']; ?>",
        name:"<?php echo $r['nome']; ?>", 
        // atosCad:"<?php echo $r['atos_cadastrados']; ?>",
        // atosExis:"<?php echo $r['atos_existentes']; ?>",
        // duvidas:"<?php echo $r['duvidas']; ?>"