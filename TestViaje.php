<?php

include_once("Viaje.php");


saludo();
$viaje = cargarViaje();

do
{   
    mostrarMenu();
    $opcion = trim( fgets( STDIN ) );

    switch ( $opcion )
    {
        case 1: echo "Ingrese nombre del pasajero:";
                $nombre = trim( fgets( STDIN ) );
                echo "Ingrese apellido del pasajero";
                $apellido = trim( fgets( STDIN ) );
                echo "Ingrese numero DNI del pasajero:";
                $dni = trim( fgets( STDIN ) );
                
                if ( !$viaje->estaPasajero($dni) )
                {
                    $viaje->agregarPasajero( $nombre, $apellido, $dni );
                    echo "pasajero agregado exitosamente";
                }
                else 
                    echo "Error -- PASAJERO EXISTENTE";
                break;

        case 2: echo "Ingrese numero DNI del pasajero que desea eliminar:";
                $dni = trim( fgets( STDIN ) );
                
                if ( $viaje->estaPasajero( $dni ) )
                {
                    $viaje->eliminarPasajero( $dni );
                    echo "pasajero eliminado exitosamente";
                }         
                else
                    echo "Error -- PASAJERO INEXISTENTE";

            break;
        case 3: echo "Ingrese numero del pasajero:";
                $posicion = trim( fgets( STDIN ) );
                echo "Ingrese nuevo Nombre del pasajero";
                $nuevoNombre = trim( fgets( STDIN ) );

                if ( $viaje->posicionValidaCreada( $posicion ) )
                    echo $viaje->setNombrePasajero( $nuevoNombre, $posicion );
                else
                    echo "Numero de pasajero invalido";
            break;

        case 4: echo "Ingrese numero del pasajero:";
                $posicion = trim( fgets( STDIN ) );
                echo "Ingrese nuevo Apellido del pasajero";
                $nuevoApellido = trim( fgets( STDIN ) );

                if ( $viaje->posicionValidaCreada( $posicion ) )
                    echo $viaje->setApellidoPasajero( $nuevoApellido, $posicion );
                else
                    echo "Numero de pasajero invalido";
            break;  

        case 5: echo "Ingrese numero del pasajero:";
                $posicion = trim( fgets( STDIN ) );
                echo "Ingrese nuevo DNI del pasajero";
                $nuevoDni = trim( fgets( STDIN ) );

                if ( $viaje->posicionValidaCreada( $posicion ) )
                    echo $viaje->setDniPasajero( $nuevoDni, $posicion );
                else
                    echo "Numero de pasajero invalido";                 
            break;

        case 6:  echo "Ingrese numero del pasajero:";
                 $numero = trim( fgets( STDIN ) );

                 if ( $viaje->posicionValidaCreada( $numero ) )
                    echo $viaje->getInfoUnPasajero( $numero );
                 else
                    echo "Numero de pasajero invalido"; 
            break; 

        case 7:  echo $viaje->getListaPasajeros();
            break;

        case 8:  echo $viaje->__toString();
            break;

        case 0:  echo "FIN DE PROGRAMA";
            break;
        
        }
}
while( $opcion != 0 );

function saludo()
{
    echo "****************************\n";
    echo "Bienvenido a Viaje Feliz!!!!\n";
}

function cargarviaje()
{    
    echo "Ingrese codigo del viaje:";
    $codigo = trim( fgets( STDIN ) );
    echo "Ingrese destino del viaje:";
    $destino = trim( fgets( STDIN ) );
    echo "Ingrese cantidad maxima de pasajeros";
    $pasajeros = trim( fgets( STDIN ) );

    return new Viaje( $codigo, $destino, $pasajeros );
}

function mostrarMenu()
{
    echo "\nSeleccione una opción";
    echo "1: Agregar pasajero";
    echo "2: Eliminar pasajero";
    echo "3: Modificar Nombre de un pasajero";
    echo "4: Modificar Apellido de un pasajero";
    echo "5: Modificar DNI de un pasajero";
    echo "6: Mostrar Datos de un pasajero";
    echo "7: Mostrar Lista de pasajeros";
    echo "8: Mostar información del viaje";
    echo "0: Salir \n";
}

?>