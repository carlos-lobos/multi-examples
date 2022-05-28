#!/usr/bin/env python

"""
Cadena de documentacion del modulo.
"""

import sys
import optparse

def procesar_linea_comandos(argv):
    """
    Devuelve una tupla de dos elementos: (objeto preferencias, lista args).
    `argv` es una lista de argumentos, o `None` para ``sys.argv[1:]``.
    """
    if argv is None:
        argv = sys.argv[1:]

    # inicializamos el parser:
    parser = optparse.OptionParser(
        formatter=optparse.TitledHelpFormatter(width=78),
        add_help_option=None)

    # a continuacion definimos las opciones:
    parser.add_option(      # descripcion personalizada; coloca --help al final
        '-h', '--help', action='help',
        help='Muestra este mensaje de ayuda y termina.')

    prefs, args = parser.parse_args(argv)

    # comprueba el numero de argumentos, verifica los valores, etc.:
    if args:
        parser.error('el programa no soporta ningun parametro de linea de comandos; '
                     'se ignora "%s".' % (args,))

    # cualquier otra cosa que haya que hacer con las preferencias y los argumentos

    return prefs, args

def main(argv=None):
    prefs, args = procesar_linea_comandos(argv)
    # aqui iria el codigo de la aplicacion, como:
    # ejecutar(prefs, args)
    return 0        # exito

if __name__ == '__main__':
    estado = main()
    sys.exit(estado)
