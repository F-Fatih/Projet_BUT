public class Test {

	public static void main(String[] args) {
		
		//		Test de la class Nombre qui herite de 'Expression'
		System.out.println("--------------->		Test de la class 'Nombre' qui herite de 'Expression'		<---------------");
		Expression nbr1 = new Nombre(10);
		Expression nbr2 = new Nombre(5);
		Expression zero = new Nombre(0);
		//Test valeur()
		System.out.println(nbr1.valeur());
		System.out.println(nbr2.valeur());
		//Test toString() (ajout espace au debut et � la fin)
		System.out.println(nbr1.toString());
		System.out.println(nbr2.toString());
		
		
		/*
		//		Test de la class Operation (afin de tester Operation nous avons enlever la methode abstrait)
		System.out.println("\n--------------->		Test de la class 'Operation' qui herite de 'Expression'		<---------------");
		Expression op1 = new Operation(nbr1, nbr2);
		//Test getOPerande1 & getOPerande2
		System.out.println(op1.getOPerande1());
		System.out.println(op1.getOPerande2());
		//Test valeur() (il est censer envoyer un 0)
		System.out.println(op1.valeur());
		*/
		
		

		//Test de la class Addition qui herite de 'Expression'
		System.out.println("\n--------------->		Test de la class 'Addition' qui herite de 'Expression'		<---------------");
		Expression addition = new Addition(nbr1, nbr2);
		//Test toString() & valeur()
		System.out.println(addition.toString()+ " = " + addition.valeur());
		
		
		//Test de la class Soustraction qui herite de 'Expression'
		System.out.println("\n--------------->		Test de la class 'Soustraction' qui herite de 'Expression'		<---------------");
		Expression soustraction = new Soustraction(nbr1, nbr2);
		//Test toString() & valeur()
		System.out.println(soustraction.toString()+ " = " + soustraction.valeur());
		
		
		//Test de la class Multiplication qui herite de 'Expression'
		System.out.println("\n--------------->		Test de la class 'Multiplication' qui herite de 'Expression'		<---------------");
		Expression multiplication = new Multiplication(nbr1, nbr2);
		//Test toString() & valeur()
		System.out.println(multiplication.toString()+ " = " + multiplication.valeur());
		
		
		//Test de la class Division qui herite de 'Expression'
		System.out.println("\n--------------->		Test de la class 'Division' qui herite de 'Expression'		<---------------");
		Expression division = new Division(nbr1, nbr2);
		//Test toString() & valeur()
		System.out.println(division.toString()+ " = " + division.valeur());
		
		
		//Test de la class Division qui herite de 'Expression' / #Test Exception
		System.out.println("\n--------------->		Test de la class 'Division'		<---------------");
		try {
			Expression divisionE = new Division(nbr1, zero);
			//Test toString() & valeur()
			System.out.println(divisionE.toString()+ " = " + divisionE.valeur());
		} catch(ArithmeticException e) {
			System.out.println("Voici l'erreur : " + e);
		}
		
	
		
	}

}
