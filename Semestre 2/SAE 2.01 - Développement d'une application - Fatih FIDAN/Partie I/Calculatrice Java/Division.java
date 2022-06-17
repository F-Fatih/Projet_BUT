public class Division extends Operation{

	public Division(Nombre nbr_1, Nombre nbr_2) throws ArithmeticException {
		super(nbr_1, nbr_2);
		if(nbr_2.valeur()==0) {
			throw new ArithmeticException ("--------->	Vous ne pouvez pas divisé par 0 !	<---------");
		}
	}
	
	//Première version de valeur() avant d'ajouter une 'Exception'
	/*
	public int valeur() {
		if(this.getOPerande2().valeur()==0) {
			System.out.println("Vous ne pouvez pas diviser par 0");
		}
		return this.getOPerande1().valeur() / this.getOPerande2().valeur();
	}
	*/
	
	public int valeur() {
		return this.getOPerande1().valeur() / this.getOPerande2().valeur();
	}
	
	public String toString() {
		return "(" + this.getOPerande1().valeur() + " / " + this.getOPerande2().valeur() + ")" ;
	}
	
}