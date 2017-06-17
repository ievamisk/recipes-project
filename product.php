<?php session_start();
$_SESSION['stepcount']=0;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <meta charset="utf-8">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">

    <?php include("category_list.php");?>

</head>
<body>
<?php include(dirname(__FILE__)."/navbar.php");?>
<div class="container center-align">

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {//Add new step button function
        var counter = 2;
        var count=1;
        $("#add_step_btn").click(function () {
            if(counter>10){
                alert("Only 10 textboxes allow");
                return false;
            }
            var newRow = $(document.createElement('div')).attr( "id", 'textareadiv'+counter);
            newRow.attr("class",'row');
            var newTextBoxDiv = $(document.createElement('div'))
                .attr("class", 'input-field col s6');
            newTextBoxDiv.after().html(
                '<textarea name="textarea' + counter + '" class="materialize-textarea" id="textarea' + counter + '" ></textarea>'
                +
                '<label for="textarea '+counter+' ">'+ counter + ' zingsnis </label>');
            newRow.appendTo("#step_1");
            newTextBoxDiv.appendTo("#textareadiv" + counter);
            count++;
            counter++;
        });
    });
</script>

<script>
    $(document).ready(function () {// Add new ingredient button function
        var counter=1;

        $("#add_new_ingredient_btn").click(function () {
            counter++;
            var $cloneddiv =$("#c_selecr").clone(true).attr('id',"clone"+counter).appendTo("#new_ingredientdiv");
            $cloneddiv.find('[id]').each(function () {
                if(this.id=="ingredient1"){
                    this.id="ingredient"+(counter);
                    this.name="ingredient"+(counter);
                }
                else if(this.id == "amount1"){
                    this.id="amount"+(counter);
                    this.name="amount"+(counter);
                }else if(this.id == "measurment_unit1"){
                    this.id="measurment_unit"+(counter);
                    this.name="measurment_unit"+(counter);
                }
                else if(this.id == "amountdiv1")
                    this.id="amountdiv"+(counter);
            });
            $cloneddiv.find('select').each(function () {
                $(this).material_select();
            });
            if($("#amountdiv"+counter).hide()){
                $("#amountdiv"+counter).show();
            }
            Add_i_counter=1;
        });

        //ADD/REMOVE NEW INGREDIENT INPUT
        var Add_i_counter=1;
        $("#ingredient"+counter).on("change", function () {
            if($(this).val()==="last"){

                if(Add_i_counter>1){
                    alert("Galima prideti tik viena ingredienta");
                    return false;
                }
                var newRow =$(document.createElement('div')).attr("class", 'row');
                newRow.attr("id",'add_new_ingredient'+counter);

                var newAdd_ingredient_input=$(document.createElement('div')).attr("id",'addingredient'+counter);
                newAdd_ingredient_input.attr("class",'input-field col s6');

                newAdd_ingredient_input.after().html(
                    '<input id="addingredient'+counter+'" type="text" name="addingredient'+counter+'" class="validate">' +
                    '<label for="addingredient'+counter+'" data-error ="Iveskite kazka">Ingrediento pavadinimas</label>'
                );
                newRow.appendTo("#new_ingredientdiv");
                newAdd_ingredient_input.appendTo("#add_new_ingredient"+counter);
                Add_i_counter++;
            }
            else {
                $("#add_new_ingredient"+counter).remove();
                Add_i_counter=1;
            }
        });
        $("#measurment_unit"+counter).on("change", function () {
            if ($(this).val()==="taste"){
                $("#amountdiv"+counter).hide();
            }else{
                $("#amountdiv"+counter).show();
            }
        });
    });
</script>
<div class="row">
    <form class="col s12" action="add_product.php" method="post" >
            <h3 class="center-align">Add product</h3>
        <div class="row">
            <div class="input-field col s6">
                <input id="product_name" type="text" name="product_name" class="validate">
                <label for="product_name" data-error ="Iveskite kazka">Pavadinimas</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select id="type" name="type">
                    <?php type_list();?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select id="category" name = category>
                    <?php category_list();?>
                </select>
                <label for="category" data-error ="Iveskite kazka">Kategorijos</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <textarea id="description" class="materialize-textarea" name="description" data-length="120"></textarea>
                <label for="description" data-error ="Iveskite kazka">Aprašymas</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select id="cooking_time" name="cooking_time">
                    <option value="" disabled selected>Gaminimo trukmė</option>
                    <option value="15 min.">15 min.</option>
                    <option value="30 min.">30 min.</option>
                    <option value="45 min.">45 min.</option>
                    <option value="1 h.">1 h.</option>
                </select>
                <label for="cooking_time" data-error ="Iveskite kazka">Gaminimo laikas</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select id="portion" name="portion">
                    <option value="" disabled selected>Porcijo</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="8">8</option>
                </select>
                <label for="portion" data-error ="Iveskite kazka">Porcijos</label>
            </div>
        </div>
        <div class="row" id="c_selecr">
            <div class="input-field col s6">
                <select id="ingredient1" name="ingredient1">
                    <?php ingredient_list();?>
                    <option value="last"  >Pridėti ingredientą</option>
                </select>
                <label for="ingredient1" data-error ="Iveskite kazka">Ingredientai</label>
            </div>
            <div class="input-field col s2" id="amountdiv1">
                <input type="text" name="amount1" id="amount1" class="validate">
                <label for="amount1" data-error="Iveskite kazka">Kiekis</label>
            </div>
            <div class="input-field col s3">
                <select id="measurment_unit1" name="measurment_unit1">
                    <option value="" disabled selected>Matavimo vienetai</option>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="ml">ml</option>
                    <option value="l">l</option>
                    <option value="vnt">vnt</option>
                    <option value="a.š">a.š</option>
                    <option value="v.š">v.š</option>
                    <option value="stiklinė">stiklinė</option>
                    <option value="pakuotė">pakuotė</option>
                    <option value="kubelis">kubelis</option>
                    <option value="riekė">riekė</option>
                    <option value="skardinė">skardinė</option>
                    <option value="pagal-skonį">pagal skonį</option>
                    <option value="žiupsnelis">žiupsnelis</option>
                </select>
                <label for="measurment_unit1" data-error="Pasirinkite">Matavimo vienetei</label>
            </div>
        </div>
        <div id="new_ingredientdiv">

        </div>

        <div class="row">
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" id="add_new_ingredient_btn" name="add_new_ingredient_btn" type="button">Naujas ingredientas</button>
            </div>
        </div>
        <div class="row ">
            <div class="input-field col s6">
                <textarea class="materialize-textarea" id="textarea1" name="textarea1" data-length="120"></textarea>
                <label for="textarea1" data-error ="Iveskite kazka">1 žingsnis</label>
            </div>
        </div>
        <div id="step_1">

        </div>

        <div class="row">
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" id="add_step_btn" type="button" name="add_btn">Naujas žingsis
                </button>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s6">
                <input type="text" name="picture" id="picture" class="validate">
                <label for="picture" data-error="Iveskite kazka">Paveiksliuko url</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light" type="submit" name="add" id="add">Prideti
                </button>
            </div>
        </div>

    </form>
</div>
</div>

</body>
</html>