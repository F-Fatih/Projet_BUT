public class Division extends Operation{

	public Division(Expression nbr_1, Expression nbr_2) throws ArithmeticException {
		super(nbr_1, nbr_2);
		if(nbr_2.valeur()==0) {
			throw new ArithmeticException ("--------->	Vous ne pouvez pas divise par 0 !	<---------");
		}
	}

	public double valeur() {
		return this.getOPerande1().valeur() / this.getOPerande2().valeur();
	}
	
	public String toString() {
		return "(" + this.getOPerande1().toString() + " / " + this.getOPerande2().toString() + ")" ;
	}
	
}