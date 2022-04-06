<?php

class Viaje
{
    private $codigoViaje;
    private $destino;
    private $cantMaximaPasajeros;
    private $pasajeros;

    public function __construct($code, $target, $cupoMaximo)
    {
        $this->codigoViaje = $code;
        $this->destino = $target;
        $this->cantMaximaPasajeros = $cupoMaximo;
        $this->pasajeros = array();
        
    }

    // --------------- SETS
    /**
     * Set the value of codigoViaje
     *
     */ 
    public function setCodigoViaje($codigoViaje)
    {
        $this->codigoViaje = $codigoViaje;
    }

    /**
     * Set the value of destino
     */ 
    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    /**
     * Set the value of cantMaximaPasajeros
     */ 
    public function setCantMaximaPasajeros($cantMaximaPasajeros)
    {
        $this->cantMaximaPasajeros = $cantMaximaPasajeros;
    }

    /**
     * Set the value of pasajeros
     */ 
    public function setPasajeros($pasajeros)
    {
        $this->pasajeros = $pasajeros;
    }

    public function setNombrePasajero( $nuevoNombre, $posicion )
    {
        $this->modificaDatoPasajero( 'nombre', strtoupper( $nuevoNombre ), $posicion );
    }

    public function setApellidoPasajero( $nuevoApellido, $posicion )
    {
        $this->modificaDatoPasajero( 'apellido', strtoupper( $nuevoApellido ), $posicion );
    }

    public function setDniPasajero( $nuevoDni, $posicion )
    {
        $this->modificaDatoPasajero( 'dni', $nuevoDni , $posicion );
    }

    private function modificaDatoPasajero( $claveBuscada, $nuevoValor, $posicion )
    {
        if( $this->posicionValidaCreada( $posicion ) )
        {
            $auxPasajeros = $this->getPasajeros();
            $pasajeroActual = $this->getPasajeros()[ $posicion ];

            foreach( $pasajeroActual as $clave => $valor )
            {
                if( $clave == $claveBuscada )
                    $pasajeroActual [ $clave ] = $nuevoValor;
            }
            
            $auxPasajeros[ $posicion ] = $pasajeroActual;
            $this->setPasajeros( $auxPasajeros );
        }        
    }
    
    public function posicionValidaCreada( $posicion )
    {
        return( $posicion >= 0 &&
                    $posicion < count( $this->getPasajeros() ) );
    }



    //  ------------ GETS
    /**
     * Get the value of codigoViaje
     */ 
    public function getCodigoViaje()
    {
        return $this->codigoViaje;
    }

    /**
     * Get the value of destino
     */ 
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Get the value of cantMaximaPasajeros
     */ 
    public function getCantMaximaPasajeros()
    {
        return $this->cantMaximaPasajeros;
    }

    /**
     * Get the value of pasajeros
     */ 
    public function getPasajeros()
    {
        return $this->pasajeros;
    }

    public function agregarPasajero( $nombre, $apellido, $dni )
    {
        if( !$this->estaPasajero( $dni ) && !$this->estaCompleto() )
        {            
            $array_temp = $this->getPasajeros();
            $nuevaPosicion = count( $this->getPasajeros() );
            $array_temp[ $nuevaPosicion ] = array( 'nombre' => strtoupper( $nombre ), 
                                                    'apellido' => strtoupper( $apellido ),
                                                    'dni' => $dni );
            $this->setPasajeros( $array_temp );                                        
        }
    }
    public function eliminarPasajero( $dni )
    {
        if( count( $this->getPasajeros()) != 0 )
        {
            $posicion = $this-> getPosicionPasajero( $dni );
            
            if ( $posicion != -1 )
            {
                $aux = $this->getPasajeros;
                unset( $aux[ $posicion ] ); #elimina indice
                $this->setPasajeros( array_values( $aux ) ); #desplaza indices   
            }
        }
    }
    
    public function estaCompleto()
    {
        return  $this->getCantMaximaPasajeros == count( $this->getPasajeros() ) ;
    }
    public function estaPasajero( $dniBuscado )
    {
        $resultado = false;
        $cantidad = count( $this->getPasajeros() );

        for( $i = 0; $i < $cantidad ; $i++ )
        {
            foreach( $this->getPasajeros()[ $i ] as $clave => $valor )
            {
                if ( $clave == $dniBuscado )
                $resultado = true;
            }   
        } 

        return $resultado;
    }

    public function buscarPasajero( $dniBuscado )
    {
        $resultado = null;
        $cantidad = count( $this->getPasajeros() );
        $corte = false;
        $i = 0;

        while( $i < $cantidad && !$corte )
        {            
            foreach( $this->getPasajeros()[ $i ] as $clave => $valor )
            {
                if ( $clave == $dniBuscado )
                {
                    $resultado = $this->getPasajeros()[ $i ];
                    $corte = true;
                }
            }   
            $i++;
        } 

        return $resultado;
    }
    
    private function getPosicionPasajero( $dniBuscado )
    {
        $resultado = -1;
        $cantidad = count( $this->getPasajeros() );
        $corte = false;
        $i = 0;

        while( $i < $cantidad && !$corte )
        {            
            foreach( $this->getPasajeros()[ $i ] as $clave => $valor )
            {
                if ( $clave == $dniBuscado )
                {
                    $resultado =  $i ;
                    $corte = true;
                }
            }   
            $i++;
        } 

        return $resultado;
    }

    public function getListaPasajeros()
    {
        $resultado = "";
        $cantidadElementos = count( $this->getPasajeros() );

        if ( $cantidadElementos != 0 )
        {
            for ( $i = 0; $i < $cantidadElementos; $i++ )
            $resultado = $resultado . $this->getInfoUnPasajero( $i );

        }
        else
            $resultado = "No hay pasajeros para este viaje";
        
        return $resultado;
    }
    public function getInfoUnPasajero( $posicion )
    {
        $resultado = null;
        if( $this->posicionValidaCreada( $posicion ) )
        {
            $temp = $this->getPasajeros()[ $posicion ];
            $nombre = $temp[ 'nombre' ];
            $apellido = $temp[ 'apellido' ];
            $dni = $temp[ 'dni' ];
            $posicion++;
            
            $resultado = "\n==========================\n
                            Pasajero N°: $posicion \n
                            Nombre: $nombre \n
                            Apellido: $apellido \n
                            DNI: $dni \n
                            ==========================\n
                            ";
        }

        return $resultado;
    }
    public function __toString()
    {
        $resultado = "\n============================================================\n
                      Codigo viaje:              $this->getCodigoViaje() \n
                      Destino:                   $this->getDestino() \n
                      Maximo Pasajeros:          $this->getCantMaximaPasajeros() \n
                      ".$this->getListaPasajeros();
        
        return $resultado;
    }

}

?>