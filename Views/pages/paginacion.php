<?php
if ($total_paginas > 1) {
?>
    <div class="cont-pag">
        <div class="paginacion">
            <?php
            if (isset($_GET['pagina'])) {
                $empezar_pag = $_GET['pagina'];
            } else {
                $empezar_pag = 1;
            }

            //Establecer cantidad maxima de numeros que pueden mostrarse en la paginacion.
            $max_pag = 5;

            if (($max_pag % 2) == 0) {
                $par = 1;
            }

            if ($max_pag != 2) {
                if (isset($par)) {
                    $der = $max_pag / 2;
                    $izq = $der - 1;
                } else {
                    $der = ($max_pag - 1) / 2;
                    $izq = $der;
                }
            } else {
                $der = 1;
                $izq = $der;
            }

            if (isset($_GET['pagina'])) {

                echo "<a href='?#'><button type='button' title='Ir a la primera página'> << </button></a>";
            }

            for ($i = $empezar_pag; $izq > 0; $izq--) {
                if (isset($_GET['pagina'])) {
                    if ($i != $izq) {
                        echo "<a href='?pagina=" . ($i - $izq) . "'><button type='button'>" . ($i - $izq) . "</button></a>";
                    }
                }
            }

            $terminar_pag = $empezar_pag + $der;

            for ($i = $empezar_pag; $i <= $terminar_pag and $i <= $total_paginas; $i++) {
                if (isset($_GET['pagina'])) {


                    if ($i == $_GET['pagina']) {


                        echo "<a href='?pagina=" . $i . "'><b><button type='button'  class='pag-selected'>" . $i . "</button></b></a>";
                    } else {

                        echo "<a href='?pagina=" . $i . "'><button type='button'>" . $i . "</button></a>";
                    }
                } else {
                    if ($i == 1) {

                        echo "<a href='?pagina=" . $i . "'><b><button type='button'  class='pag-selected'>" . $i . "</button></b></a>";
                    } else {

                        echo "<a href='?pagina=" . $i . "'><button type='button'>" . $i . "</button></a>";
                    }
                }
            }
            if (isset($_GET['pagina'])) {
                if ($_GET['pagina'] != $total_paginas) {
                    echo "<a href='?pagina=" . $total_paginas . "'><button type='button' title='Ir a la última página'> >> </button></a>";
                }
            } else {
                if (1 != $total_paginas) {
                    echo "<a href='?pagina=" . $total_paginas . "'><button type='button' title='Ir a la última página'> >> </button></a>";
                }
            }

            ?>
        </div>
    </div>
<?php
}
?>