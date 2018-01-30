<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Calculadora</title>
    </head>
    <body>
        <?php
        require 'auxiliar.php';

        define ('OPERACIONES', ['+','-','*','/']);
        //preg_split('//u', $cadena, -1, PREG_SPLIT_NO_EMPTY); -->
        //str_split pero con expresiones regular para separar los elementos.
        // $ope = $op1 = $op2 = null;
        // extract($_GET,EXTR_IF_EXISTS);
        $op1 = filter_input(INPUT_GET,'op1',FILTER_VALIDATE_FLOAT);
        $op2 = filter_input(INPUT_GET,'op2',FILTER_VALIDATE_FLOAT);
        $ope = filter_input(INPUT_GET,'ope');

        $error = [];

        try{
            compruebaParametros($op1,$op2,$ope,$error);
            compruebaOperador($ope,OPERACIONES,$error);
            compruebaNumericos($op1,$op2,$error);
            compruebaErrores($error);
            $op1 = eval("return $op1 $ope $op2;");
        }catch(Exception $e){
            mostrarErrores($error);

        }
        dibujaFormulario($op1,$op2,$ope,OPERACIONES);
        ?>
        <br/>
    </body>
</html>
