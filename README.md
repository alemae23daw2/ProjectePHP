# ProjectePHP
Cosas a hacer:
Redirecionament de http a https --> apache.htaccess
shan dutilitzar els metodes correctes per a cada peticio (borrar : delete)
minim un method spoofing para PUT y DELETE
s'ha de obligar al usuari a utilitzar contraseña segura
en tot moment s'ha de poder anar a la pagina anterior
usuario visible en todo momento (foto a la izquierda + nombre)
en tot moment s'ha de poder fer log out
no es pot accedir a una URL si no estas autoritzat IMPORTANTE
en cas de error d'aces a una pagina sa de posra explicacio error i boto log out

Cal definir classes i instanciar objectes. S'hauran d'utilitzar mètodes màgics (al menys, el
mètode constructor), herència i interfícies.
No es pot utilitzar JavaScript o qualsevol altre llenguatge del costat client excepte en la
presentació i en la pàgina d'informació de l'aplicació.
S'han d'utilitzar frameworks per facilitar el desenvolupament de l'aplicació. Com a mínim per
l'enviament de correu via GMail (o qualsevol altre servidor que ho permeti) i per la generació
de fitxers PDF.

pagina bienvenida
pagina de login
    nom y contra (identificar cada usuari)
    si es admin acces total
    si es gestor te acces a pagines de gestio
    si es client nomes al cataleg
    
admiistracion de usuarios
    administrador/gestor/client
    admin nomes 1 --> paswd: fjeclot correu: admin@fjeclot.net i ha de poder cambiar totes les seves dades 
        crear/editar/borrar gestores con ID, nom usr, contra, nom complet, correo, telf
        lista de tots gestor ordenat per nom i totes les dades
        boto per descarregar en pdf

        creacio de clients --> ID, usuari, conta, nom complet, correu, telf, adreça postal, num visa, ID del gestor (que lo gestiona xd)
        carpeta comandes on es crea una carpeta per cada usuari
        carpeta cistelles on es creara una carpeta personal amb el nom del client dins
        se de poder ver la lista de clientes de la tienda ordenado por nombre y todos sus datos
        boto exportar en pdf
        editar y borrar clientes (si se borrra un cliente se borra la carpeta y si se editan se editan)


    restricciones --> clientes no pueden tener acceso al area de administracion de usuarios / los gestores no pueden gestionar gestores / los gestores tienen que podere SUS CLIENTES que gestionan

    los gestores pueden enviar un correo al administrador pidiendo una adicion de usuarrio modificacion o eliminacion, El contingut del correu
    és lliure per s'ha d'enviar des d'un formulari dins de l'aplicació però l'assumpte ha de ser "petició d'addició/modificació/esborrament de client".





gestion de catalogos de productos 
    carac producte: Nom, NUmID, preu, IVA, disponibilitat (si o no)
    los gestores pueden crear/modificar/eliminar productos
    visualizar productos por nombre y datos
    boton export pdf
    los clientes no pueden ver la area de gestion de catalogo y el admin tampoco


gestion area clientes
    perfil del client
    puede ver datos personales
    enviar correo al admin para modificar o eliminar su cliente: El contingut del correu és lliure però s'ha d'enviar des d'un
    formulari dins de l'aplicació i a l'assumpte ha de posar "petició de
    modificacio/esborrament del compte de client".
    pueden enviar correo para el motivo de comanda rechazada: El contingut del correu és lliure però s'ha d'enviar des d'un
    formulari dins de l'aplicació i a l'assumpte ha de posar "petició de justificació de comanda rebutjada".
    gestionar cistella y comanda
    1 cistella se convierte en una comnada cuando el cliente la compra

    gestion de cistella
    1 cliente puede netrar al catalogo y ver sus productos y caract (aunque no haya disponibilidad)
    puede selecionar cuantos productos quiera pero deben estar disponibles
    indicar quantitat
    boton de finalizacion de secion de productos y cantidad de productos
    despues de esta pagina va una lista de todos los productos con niombre cantidad ,precio sin IVA valor del IVA y precio final con IVA
    ha de haber un total de precio tot sin iva del iva solo y con el iva
    sha de poder ver la data y hora actual (reloj)
    boton de aceptar y crear comnada 
    boton de atras y modificar cistella
    al crear comanda borra la cistella
    la cistella es un fitxer dins la crpeta cistella de cada usuari i quan el usuari tenca sesio ha de preguntar si vol mantenir o borrar la cistella
    nomes pot tenir 1 cistella

    gestion de comanda
    la comanda es un fichero dentro de la carpeta personal de comandas, solo puede haber una comanda
    la ha de poder exportar en pdf 
    el cliente a de poder enviar un correo a su gestor piediendo esborrar la comanda
    la comanda no se puede modificar
    gestor de botiga no pueden crear comandes
    los gestores no pueden editar/ver/crear/borrar la cistella

gestion de tramitacion de comandas
    cuando un gestor elimina una comanda del cliente se envia un mensaje por correo al cliente informandolo: El contingut del correu és lliure però a l'assumpte ha de posar "petició
    d'esborrament de la comanda realitzat"

    un gesto puede rebutjar una comanda i es notifica la client: El contingut del correu és lliure però a l'assumpte ha de posar "comanda rebutjada"
    un gesto puede tramitar una comanda i es notifica la client: El contingut del correu és lliure però a l'assumpte ha de posar "tramitant la comanda"
    un gesto puede finaltitzar una comanda i es notifica la client: El contingut del correu és lliure però a l'assumpte ha de posar "comanda finalitzada"

    el admin no puede ver la tramitacion de comandas


hacer catalogo

