// 6) Estructuras3: Realiza el mismo ejercicio del apartado anterior ahora con un 
// switch
const nota = parseInt(prompt('Introduzca nota: '));

switch ( nota ) {
    case (0):
    case (1): 
    case (2): 
    case (3): 
    case (4): 
        alert('Suspenso');
        break;
    case (5): 
        alert('Suficiente');
        break;
    case (6): 
    case (7): 
        alert('Bien');
        break;
    case (8): 
    case (9): 
        alert('Notable');
        break;
    case (10): 
        alert('Sobresaliente');
        break;
    default :
        alert('No has introducido una nota válida.');
}
