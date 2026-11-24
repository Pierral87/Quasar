<?php 

class A 
{
    public function testA() 
    {
        return "testA";
    }
}

class B extends A
{
    public function testB() 
    {
        return "testB";
    }
}

class C extends B
{
    public function testC() 
    {
        return "testC";
    }
}

$c = new C;
var_dump(get_class_methods($c));

/* 

    Si C hérite de B 
        que B hérite de A 
            alors C hérite de A même s'il n'y a pas de référence directe entre les deux, c'est la classe B qui joue l'intermédiaire ici 

    --- C'est ce qu'on appelle la transitivité --- 

    Autres détails sur l'héritage : 

        - Non réflexif : class D extends D // Erreur, une classe ne peut pas hériter d'elle même 
        - Non symétrique : class F exnteds E // F qui récupère les éléments de E, mais E n'hésite pas des éléments de F 
        - Sans cycle : class Y extends X 
                        class X extends Y // Erreur, ce n'est pas possible de faire un héritage dans un sens puis dans un autre 
        - Pas d'héritage multiple : class G extends I, J, K // Erreur... Mais pour ça, on aura, les traits ! 

*/