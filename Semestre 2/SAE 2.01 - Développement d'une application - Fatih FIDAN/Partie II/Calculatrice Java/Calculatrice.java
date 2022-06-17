
public class Calculatrice {

	public static void main(String[] args) {
		//Les nombres :
		Expression zero = new Nombre(0);
		Expression un = new Nombre(1);
		Expression deux = new Nombre(2);
		Expression trois = new Nombre(3);
		Expression quatre = new Nombre(4);
		Expression cinq = new Nombre(5);
		Expression six = new Nombre(6);
		Expression sept = new Nombre(7);
		Expression huit = new Nombre(8);
		Expression neuf = new Nombre(9);
		Expression dix = new Nombre(10);
		Expression dixSept = new Nombre(17);
		
		
		System.out.println("---------->   Code du sujet de la Partie II   <----------");
		//Code du sujet de la Partie II		
		Expression s = new Soustraction(dixSept, deux) ;
		Expression a = new Addition(deux, trois) ;
		Expression d = new Division(s, a) ;
		System.out.println(d + " = " + d.valeur()) ; // affiche ((17 - 2) / (2 + 3)) = 3

		
		System.out.println("\n---------->   Code écrit par Fatih & Tamij   <----------");
		//Code écrit par Fatih et Tamij
		Expression PLUS = new Addition(dixSept, deux);
		System.out.println(PLUS + " = " + PLUS.valeur());
		
		Expression MOINS = new Soustraction(dixSept, deux);
		System.out.println(MOINS + " = " + MOINS.valeur());
		
		Expression FOIS = new Multiplication(dixSept, deux);
		System.out.println(FOIS + " = " + FOIS.valeur());
		
		try {
			Expression DIVISERsans0 = new Division(dixSept,deux);
			System.out.println(DIVISERsans0 + " = " + DIVISERsans0.valeur()) ;
		} catch (Exception e) {
			System.out.println("\nIl y a une erreur !\nLa voici : " + e);
		}
		
		try {
			Expression DIVISEavec0 = new Division(dixSept,zero);
			System.out.println(DIVISEavec0 + " = " + DIVISEavec0.valeur()) ;
		} catch (Exception e) {
			System.out.println("\nIl y a une erreur !\nLa voici : " + e);
		}
		
		
		System.out.println("\n---------->   opérations composées   <----------");
		Expression OC_calc_2_1 = new Addition(sept, trois);
		Expression OC_calc_2_2 = new Soustraction(huit, cinq);
		Expression OC_calc_2_3 = new Soustraction(dix, un);
		Expression OC_calc_2_4 = new Addition(deux, six);
		Expression OC_calc_2_5 = new Multiplication(OC_calc_2_1, OC_calc_2_2);
		Expression OC_calc_2_6 = new Multiplication(OC_calc_2_3, OC_calc_2_4);
		Expression OC_calc_2_Res = new Division(OC_calc_2_5, OC_calc_2_6);
		System.out.println(OC_calc_2_Res + " = " + OC_calc_2_Res.valeur());
		
		
		Expression OC_calc_3_1 = new Addition(un, deux);
		Expression OC_calc_3_2 = new Addition(un,sept);
		Expression OC_calc_3_3 = new Multiplication(OC_calc_3_1, OC_calc_3_2);
		Expression OC_calc_3_Res = new Multiplication(OC_calc_3_3, dix);
		System.out.println(OC_calc_3_Res + " = " + OC_calc_3_Res.valeur());

		Expression OC_calc_4_1 = new Multiplication(deux,trois);
		Expression OC_calc_4_2 = new Multiplication(quatre, deux);
		Expression OC_calc_4_Res = new Addition(OC_calc_4_1, OC_calc_4_2);
		System.out.println(OC_calc_4_Res + " = " + OC_calc_4_Res.valeur());
		
		
		Expression OC_calc_5_1 = new Multiplication(dix,dix);
		Expression OC_calc_5_2 = new Multiplication(dix,sept);
		Expression OC_calc_5_3 = new Division(OC_calc_5_1, deux);
		Expression OC_calc_5_4 = new Division(OC_calc_5_2, deux);
		Expression OC_calc_5_Res = new Soustraction(OC_calc_5_3, OC_calc_5_4);
		System.out.println(OC_calc_5_Res + " = " + OC_calc_5_Res.valeur());

		
		Expression OC_calc_6_1 = new Addition(quatre, deux);
		Expression OC_calc_6_2 = new Soustraction(un, dix);
		Expression OC_calc_6_Res = new Soustraction(OC_calc_6_1, OC_calc_6_2); 
		System.out.println(OC_calc_6_Res + " = " + OC_calc_6_Res.valeur());

		
		Expression OC_calc_7_1 = new Soustraction(un, dix);
		System.out.println(OC_calc_7_1+ " = " + OC_calc_7_1.valeur());
		
		
		Expression OC_calc_8_1 = new Soustraction(six, dix);
		Expression OC_calc_8_2 = new Soustraction(quatre, neuf);
		Expression OC_calc_8_Res = new Division(OC_calc_8_1, OC_calc_8_2);
		System.out.println(OC_calc_8_Res+ " = " + OC_calc_8_Res.valeur());

		
		Expression OC_calc_9_1 = new Soustraction(neuf, deux);
		Expression OC_calc_9_2 = new Soustraction(un, neuf);
		Expression OC_calc_9_Res = new Multiplication(OC_calc_9_1, OC_calc_9_2);
		System.out.println(OC_calc_9_Res+ " = " + OC_calc_9_Res.valeur());
		
		
		Expression OC_calc_10_1 = new Soustraction(six, cinq);
		Expression OC_calc_10_2 = new Soustraction(quatre, quatre);
		Expression OC_calc_10_Res = new Multiplication(OC_calc_10_1, OC_calc_10_2);
		System.out.println(OC_calc_10_Res+ " = " + OC_calc_10_Res.valeur());

		
		Expression OC_calc_11_1 = new Multiplication(trois,six);
		Expression OC_calc_11_2 = new Multiplication(sept,sept);
		Expression OC_calc_11_3 = new Division(OC_calc_11_1, quatre);
		Expression OC_calc_11_4 = new Division(OC_calc_11_2, deux);
		Expression OC_calc_11_Res = new Soustraction(OC_calc_11_3, OC_calc_11_4);
		System.out.println(OC_calc_11_Res + " = " + OC_calc_11_Res.valeur());
		
		try {
			Expression OC_calc_1_1 = new Soustraction(six, quatre);
			Expression OC_calc_1_2 = new Soustraction(OC_calc_1_1, deux);
			Expression OC_calc_1_3 = new Addition(neuf, dixSept);
			Expression OC_calc_1_Res = new Division(OC_calc_1_3, OC_calc_1_2);
			System.out.println(OC_calc_1_Res + " = " + OC_calc_1_Res.valeur());
		} catch (Exception e) {
			System.out.println("\nIl y a une erreur !\nLa voici : " + e);
		}
		

		
	}

}
