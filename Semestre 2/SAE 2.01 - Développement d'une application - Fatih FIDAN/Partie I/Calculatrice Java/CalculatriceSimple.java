public class CalculatriceSimple {

	public static void main(String[] args) {
		
		
		System.out.println("---------->   Code du sujet de la Partie I   <----------");
		//Code du sujet de la Partie I 
		Nombre six = new Nombre(6) ;
		Nombre dix = new Nombre(10) ;
		
		Operation s = new Soustraction(dix,six) ;
		System.out.println(s + " = " + s.valeur()) ; // doit afficher : (10 – 6) = 4
		
		
		
		System.out.println("\n---------->   Code écrit par Fatih & Tamij   <----------");
		//Code écrit par Fatih et Tamij
		Nombre zero = new Nombre(0);
		Nombre deux = new Nombre(2);
		Nombre huit = new Nombre(8);

		Operation PLUS = new Addition(huit, deux);
		System.out.println(PLUS + " = " + PLUS.valeur());
		
		Operation MOINS = new Soustraction(huit, deux);
		System.out.println(MOINS + " = " + MOINS.valeur());
		
		Operation FOIS = new Multiplication(huit, deux);
		System.out.println(FOIS + " = " + FOIS.valeur());
		
		try {
			Operation DIVISERsans0 = new Division(huit,deux);
			System.out.println(DIVISERsans0 + " = " + DIVISERsans0.valeur()) ;
		} catch (Exception e) {
			System.out.println("\nIl y a une erreur !\nLa voici : " + e);
		}
		
		try {
			Operation DIVISEavec0 = new Division(huit,zero);
			System.out.println(DIVISEavec0 + " = " + DIVISEavec0.valeur()) ;
		} catch (Exception e) {
			System.out.println("\nIl y a une erreur !\nLa voici : " + e);
		}
		
		
		
	}

}
