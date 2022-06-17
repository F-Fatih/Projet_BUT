
public class TableMultiplication {

	public static void main(String[] args) {
		
		Nombre un = new Nombre(1) ;
		Nombre deux = new Nombre(2) ;
		Nombre trois = new Nombre(3) ;
		Nombre quatre = new Nombre(4) ;
		Nombre cinq = new Nombre(5) ;
		Nombre six = new Nombre(6) ;
		Nombre sept = new Nombre(7) ;
		Nombre huit = new Nombre(8) ;
		Nombre neuf = new Nombre(9) ;
		Nombre dix = new Nombre(10) ;
		
		//Table de 1
		System.out.println("\n-------->     Table de 1     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table1 = new Multiplication(un,j) ;
			System.out.println(table1 + " = " + table1.valeur());
		}
		
		//Table de 2
		System.out.println("\n-------->     Table de 2     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table2 = new Multiplication(deux,j) ;
			System.out.println(table2 + " = " + table2.valeur());
		}
		
		//Table de 3
		System.out.println("\n-------->     Table de 3     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table3 = new Multiplication(trois,j) ;
			System.out.println(table3 + " = " + table3.valeur());
		}
		
		//Table de 4
		System.out.println("\n-------->     Table de 4     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table4 = new Multiplication(quatre,j) ;
			System.out.println(table4 + " = " + table4.valeur());
		}
		
		//Table de 5
		System.out.println("\n-------->     Table de 5     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table5 = new Multiplication(cinq,j) ;
			System.out.println(table5 + " = " + table5.valeur());
		}
		
		//Table de 6
		System.out.println("\n-------->     Table de 6     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table6 = new Multiplication(six,j) ;
			System.out.println(table6 + " = " + table6.valeur());
		}
		
		//Table de 7
		System.out.println("\n-------->     Table de 7     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table7 = new Multiplication(sept,j) ;
			System.out.println(table7 + " = " + table7.valeur());
		}
		
		//Table de 8
		System.out.println("\n-------->     Table de 8     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table8 = new Multiplication(huit,j) ;
			System.out.println(table8 + " = " + table8.valeur());
		}
		
		//Table de 9
		System.out.println("\n-------->     Table de 9     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table9 = new Multiplication(neuf,j) ;
			System.out.println(table9 + " = " + table9.valeur());
		}
		
		//Table de 10
		System.out.println("\n-------->     Table de 10     <--------");
		for(int i=0; i<=10; i++) {
			Nombre j = new Nombre(i) ;
			Operation table10 = new Multiplication(dix,j) ;
			System.out.println(table10 + " = " + table10.valeur());
		}
	}
}
