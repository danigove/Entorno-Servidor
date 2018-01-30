<?php
        function selected(?string $o,string $v): string
        {
            return $o == $v ? 'selected' : '';
        }
        ?>
        <?php
            $op1 = $op2 = $ope = null; //Obligatorio
            extract($_GET, EXTR_IF_EXISTS);
         ?>
        <?php
        /**
         * [calcula Realiza una operacion.]
         * @param  string $op1 [Primer numero de la operacion]
         * @param  string $op2 [Segundo numero de la operacion]
         * @param  strin  $ope [Operando de la operacion]
         * @return [type]      [description]
         */
        function calcula(string $op1,string $op2,string $ope)
        {
            //Opcion alternativa: (Hay que escapar el $ del $ret para que se pueda crear la variable)
            //eval("\$ret = $op1 $op $op2;");
            switch ($ope){
                case '+':
                    $ret = $op1 + $op2;
                    break;
                case '-':
                    $ret = $op1 - $op2;
                    break;
                case '*':
                    $ret = $op1 * $op2;
                    break;
                case '/':
                    $ret = $op1 / $op2;
                    break;
            }
            return $ret;
        }

        function compruebaParametros($op1,$op2,$ope, array &$error): void
        {
                //Si los tres parametros estan en la URL
                if(isset($op1, $op2, $ope)){
                    //Si algun operador esta vacio
                    if($op1 === '' || $op2 === ''){
                        $error[] = 'Falta algun parametro que estará vacio';
                        throw new Exception;
                    }
                    //Estan los tres parametros y no son vacios
                    return;
                }
                //Si falta algun parametro pero no todos.
                if($op1 !== null || $op2 !== null || $ope !== null){
                    $error[] = 'Falta algun parametro';
                }
                //Si faltan todos los parametros en la URL
                throw new Exception;
        }

        function compruebaOperador($ope, array $lista, array &$error):void
        {
            if(!in_array($ope,$lista)){
                $error[] = 'Operacion no valida';
            }
        }

        function compruebaNumericos($op1,$op2, array &$error): void
        {
            //if(in_array(false, filter_var_array([$op1,$op2], FILTER_VALIDATE_FLOAT), true)){
             if(filter_var($op1, FILTER_VALIDATE_FLOAT) === false ||
                filter_var($op2, FILTER_VALIDATE_FLOAT) === false){
                $error[] = 'Los dos operandos deben de ser numericos';
            }elseif($op1 < 0 || $op2 < 0){
                $error[] = 'Los dos operandos deben ser positivos';
            }
        }

        function compruebaErrores(array $error)
        {
            if(!empty($error)){
                throw new Exception;
            }
        }
        function mostrarErrores($error){
            foreach ($error as $v) {
                ?>
                <h3>Error: <?= $v ?>.</h3>
                <?php
            }
        }

        function dibujaFormulario($op1,$op2,$ope, $lista): void
        { ?>
            <form action="calcula.php" method="get">
                <label for="op1">Primer operando:</label>
                <input id="op1" type="text" name="op1" value="<?= htmlentities($op1)?>" /><br/>
                <label for="op2">Segundo operando:</label>
                <input id="op2" type="text" name="op2"value="<?= htmlentities($op2)?>" /><br/>
                <label for="ope">Operador: </label>
                <select id="ope" name="ope">
                    <?php
                    for($i = 0; $i < count($lista); $i++): ?>
                    <option value=<?= $lista[$i] ?> <?=selected($ope,$lista[$i]) ?>><?=$lista[$i]?>
                    </option>
                    <?php endfor ?>
                </select><br/>
                <input type="submit" value="Calcular" />
            </form>
            <?php
        }
