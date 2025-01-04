<?php

namespace ForgeBits\FabricaDeFakes\Resources;

class Name
{
    public static function getName(?string $gender = null): string
    {
        return match ($gender) {
            'female' => self::getFemaleNames()[array_rand(self::getFemaleNames())],
            'male' => self::getMaleNames()[array_rand(self::getMaleNames())],
            default => self::mergeMalesAndFemalesNames()[array_rand(self::mergeMalesAndFemalesNames())],
        };
    }

    public static function getSurname(?int $surnames = 0): string
    {
        $surname = [];

        for ($i = 0; $i < $surnames; $i++) {
            $surname[] = self::getSurnames()[array_rand(self::getSurnames())];
        }

        return implode(' ', $surname);
    }

    public static function mergeMalesAndFemalesNames(): array
    {
        return array_merge(self::getMaleNames(), self::getFemaleNames());
    }

    public static function getMaleNames(): array
    {
        return [
            "João", "Pedro", "Lucas", "Matheus", "Gustavo", "Rafael", "Bruno", "Gabriel", "Thiago", "Diego",
            "Felipe", "Leonardo", "Victor", "Daniel", "Henrique", "Ricardo", "Caio", "Vinícius", "Eduardo", "André",
            "Fernando", "Marcelo", "Rodrigo", "Alexandre", "Igor", "Arthur", "Luís", "Francisco", "Roberto", "Renato",
            "Miguel", "Paulo", "Maurício", "Fábio", "Antônio", "Carlos", "Emanuel", "Davi", "Rogério", "Bruno",
            "Luan", "Samuel", "Renan", "Jean", "Vitor", "Otávio", "Rafael", "Cristiano", "Jorge", "Elias",
            "José", "César", "Hugo", "Ivan", "Alex", "Leandro", "Juliano", "Márcio", "Osvaldo", "Adriano",
            "Thierry", "Murilo", "Cristiano", "Maurício", "Alan", "Raimundo", "Giovani", "Estevão", "Caetano", "Anselmo",
            "Ismael", "Jonas", "Matias", "Edson", "Edmilson", "Nilson", "Álvaro", "Frederico", "Duarte", "Teodoro",
            "Joaquim", "Plínio", "Raul", "Fabrício", "Guilherme", "Eron", "Adelson", "Gilberto", "Orlando", "Adonias",
            "Adriel", "Osvaldo", "Wellington", "Edvaldo", "Vicente", "Evandro", "Aníbal", "Eber", "Afonso", "Gilmar",
            "Celso", "Heraldo", "Cássio", "Ronaldo", "Luiz", "Marciano", "Mateus", "Arlindo", "Luciano", "Cleber",
            "Everaldo", "Marcos", "Robson", "Arnaldo", "Dorival", "Wesley", "Cláudio", "Alberto", "Josué", "Hermes",
            "Saulo", "Eurico", "Israel", "Ademar", "Régis", "Domingos", "Rubens", "Clóvis", "Norberto", "Heitor",
            "Sérgio", "Breno", "Eraldo", "Hermínio", "Márcio", "Ivo", "Newton", "Rodolfo", "Geraldo", "Evandro",
            "Waldemar", "Fausto", "Oséias", "Eliezer", "Aristeu", "Eugênio", "Jônatas", "Aristeu", "Adriano", "Adrião",
            "Benedito", "Benedict", "Cleiton", "Elói", "Ezequiel", "Félix", "Gaspar", "Hernani", "Joab", "Jonas",
            "Lázaro", "Max", "Napoleão", "Osmar", "Pascoal", "Quintino", "Raimundo", "Salvador", "Tadeu", "Ulisses",
            "Valter", "Washington", "Xavier", "Yago", "Zaqueu", "Abel", "Ademir", "Adilson", "Agnaldo", "Alcides",
            "Alexandre", "Aloísio", "Aluísio", "Amarildo", "Américo", "Amilton", "Aristeu", "Arnaldo", "Astolfo", "Baltazar",
            "Benício", "Benedito", "Bento", "Bernardo", "Camilo", "Carlito", "Cassiano", "Célio", "César", "Ciro",
            "Dário", "Dimas", "Dionísio", "Dorival", "Edmundo", "Élcio", "Elton", "Emanuel", "Emílio", "Eros",
            "Fausto", "Firmino", "Flávio", "Florêncio", "Francisco", "Gaspar", "Gedeão", "Gilberto", "Haroldo", "Hélio",
            "Homero", "Horácio", "Ícaro", "Índio", "Jair", "Jaques", "Joaquim", "Jonatas", "Jorge", "Josué",
            "Juarez", "Julião", "Lauro", "Léo", "Lineu", "Luiz", "Marcelo", "Márcio", "Matias", "Maurício",
            "Max", "Miguel", "Milton", "Moacir", "Murilo", "Narciso", "Natanael", "Nivaldo", "Norberto", "Nélio",
            "Olavo", "Orlando", "Osvaldo", "Otacílio", "Otoniel", "Paulo", "Pedro", "Raimundo", "Rafael", "Renato",
            "Ricardo", "Roberto", "Rodolfo", "Romário", "Romualdo", "Rubens", "Salvador", "Samuel", "Saulo", "Sérgio",
        ];
    }

    public static function getFemaleNames(): array
    {
        return [
            "Maria", "Ana", "Camila", "Bruna", "Fernanda", "Juliana", "Larissa", "Mariana", "Carla", "Daniela",
            "Sofia", "Isabela", "Vitória", "Giovanna", "Luísa", "Gabriela", "Larissa", "Beatriz", "Débora", "Aline",
            "Paula", "Tatiane", "Renata", "Cláudia", "Simone", "Raquel", "Patrícia", "Carolina", "Andréia", "Cristiane",
            "Michele", "Jéssica", "Verônica", "Adriana", "Amanda", "Cristina", "Tatiana", "Isis", "Alice", "Heloísa",
            "Letícia", "Eduarda", "Ingrid", "Marta", "Luciana", "Helena", "Natália", "Bianca", "Monique", "Lívia",
            "Elis", "Cecília", "Clarice", "Glória", "Rosa", "Flávia", "Jaqueline", "Marcela", "Alessandra", "Nicole",
            "Esther", "Larisse", "Sarah", "Catarina", "Silvana", "Joana", "Renata", "Sabrina", "Vera", "Mônica",
            "Viviane", "Rafaela", "Milena", "Érica", "Eliane", "Lucia", "Maira", "Tatiane", "Valéria", "Janaina",
            "Kelly", "Andreia", "Fabiana", "Rosana", "Jacqueline", "Lilian", "Márcia", "Nayara", "Regina", "Valéria",
            "Janaína", "Suelen", "Vanessa", "Priscila", "Maristela", "Rosemeire", "Sandra", "Claudia", "Alessandra",
            "Evelyn", "Cristina", "Emanuelle", "Gisele", "Thaís", "Joana", "Diana", "Amanda", "Rita", "Olga",
            "Fabiana", "Tereza", "Nadia", "Regiane", "Rayssa", "Suzana", "Lorena", "Tatiane", "Carolina", "Ivone",
            "Zélia", "Francisca", "Gislaine", "Marilene", "Ágata", "Samara", "Elaine", "Miriam", "Viviane", "Dilma",
            "Ariane", "Natasha", "Adélia", "Dulce", "Emília", "Isadora", "Geovana", "Andressa", "Luzia", "Márcia",
            "Rosana", "Josefina", "Raimunda", "Aparecida", "Sílvia", "Adriana", "Graciela", "Eliza", "Emanuela",
            "Célia", "Clarissa", "Antonieta", "Iara", "Caroline", "Valentina", "Aurora", "Melissa", "Cléa", "Mariah",
            "Ester", "Noemi", "Inês", "Iris", "Naiane", "Damaris", "Raissa", "Alice", "Clara", "Luana", "Iolanda",
            "Lorenna", "Nair", "Fabiane", "Luiza", "Regiane", "Ivana", "Eloá", "Adriana", "Francine", "Josiane",
            "Angélica", "Marilda", "Érica", "Marilena", "Edna", "Aline", "Débora", "Marli", "Luane", "Daiane",
            "Darlene", "Marina", "Nadja", "Rebeca", "Isabel", "Dalva", "Valdirene", "Veridiana", "Rosana", "Talita",
            "Tais", "Marjorie", "Adélia", "Geralda", "Celina", "Renilda", "Valéria", "Flora", "Vilma", "Aída",
            "Nathalia", "Sofia", "Stefanie", "Tatiane", "Paloma", "Lilian", "Érika", "Beatriz", "Naiara", "Júlia",
            "Adriane", "Fabíola", "Morgana", "Malu", "Gisele", "Ivete", "Rafaella", "Milene", "Cristina", "Samanta",
            "Suelen", "Graziella", "Tatiana", "Mara", "Cristine", "Valdineia", "Anita", "Ivone", "Mariluce", "Antonieta",
            "Alexandra", "Lisandra", "Carmem", "Roseli", "Irene", "Nina", "Tânia", "Lindalva", "Magali", "Dilma",
        ];
    }

    public static function getSurnames(): array
    {
        return [
            "Silva", "Santos", "Oliveira", "Souza", "Pereira", "Lima", "Costa", "Ferreira", "Ribeiro", "Alves",
            "Cardoso", "Martins", "Gomes", "Barbosa", "Almeida", "Monteiro", "Mendes", "Rodrigues", "Vieira", "Teixeira",
            "Carvalho", "Santana", "Nunes", "Machado", "Rocha", "Dias", "Campos", "Moraes", "Cruz", "Araújo",
            "Freitas", "Andrade", "Neves", "Moreira", "Castro", "Correia", "Sousa", "Pinto", "Amaral", "Ramos",
            "Torres", "Batista", "Fernandes", "Borges", "Vieira", "Farias", "Dantas", "Pinheiro", "Sales", "Rezende",
            "Cavalcanti", "Morais", "Antunes", "Tavares", "Domingues", "Pimentel", "Couto", "Siqueira", "Fonseca", "Braga",
            "Nogueira", "Barros", "Soares", "Coelho", "Rezende", "Xavier", "Marques", "Prado", "Cunha", "Ferraz",
            "Peixoto", "Simões", "Viana", "Guimarães", "Rossi", "Martinez", "Figueiredo", "Lopes", "Pacheco", "Carmo",
            "Azevedo", "Lacerda", "Queiroz", "Goulart", "Bittencourt", "Félix", "Brandão", "Espíndola", "Assunção", "Serrano",
            "Rangel", "Alencar", "Vargas", "Aquino", "França", "Camargo", "Menezes", "Beltrão", "Mascarenhas", "Meireles",
            "Bicalho", "Valentim", "Guedes", "Garcia", "Franco", "Macedo", "Monteiro", "Teles", "Brito", "Tavares",
            "Galvão", "Severino", "Freire", "Castilho", "Carneiro", "Quintana", "Lourenço", "Linhares", "Godoy", "Cabral",
            "Quevedo", "Martins", "Toledo", "Saldanha", "Rios", "Albuquerque", "Ventura", "Vilela", "Amarante", "Pontes",
            "Olive", "Cardoso", "Benevides", "Ambrósio", "Duarte", "Arruda", "Serra", "Castellani", "Bettencourt", "Silveira",
            "Mota", "Carmo", "Sabino", "Lobato", "Camilo", "Souto", "Reis", "Lago", "Muniz", "Ferraz",
            "Veloso", "Rabelo", "Malta", "Tito", "Gonçalves", "Fontes", "Galdino", "Pires", "Trindade", "Maia",
            "Campos", "Montenegro", "Brasil", "Caldeira", "Aragão", "Peixoto", "Chaves", "Lins", "Bastos", "Bicalho",
            "Leme", "Furtado", "Navarro", "Bacelar", "Abranches", "Valadares", "Gaspar", "Leite", "Henriques", "Azeredo",
            "Lourenço", "Ribeiro", "Nogueira", "Moreira", "Leal", "Serra", "Vasconcelos", "Gurgel", "Machado", "Ramalho",
            "Torrado", "Correia", "França", "Ramalhete", "Valença", "Coutinho", "Carneiro", "Vianna", "Castanheira", "Drumond",
            "Rabelo", "Santiago", "Bicudo", "Lopes", "Noronha", "Pereira", "Cortez", "Campos", "Mendonça", "Nóbrega",
            "César", "Fontana", "Natividade", "Tavares", "Seabra", "Guerra", "Avelar", "Vilela", "Castro", "Muniz",
            "Saraiva", "Pacheco", "Resende", "Pedrosa", "Barreto", "Mansur", "Gusmão", "Sales", "Alencastro", "Coimbra"
        ];
    }
}