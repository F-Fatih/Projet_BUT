public class Multiplication extends Operation{

	public Multiplication(Expression nbr_1, Expression nbr_2) {
		super(nbr_1, nbr_2);
	}
	
	public double valeur() {
		return this.getOPerande1().valeur() * this.getOPerande2().valeur();
	}
	
	public String toString() {
		return "(" + this.getOPerande1().toString() + " x " + this.getOPerande2().toString() + ")" ;
	}
	
}