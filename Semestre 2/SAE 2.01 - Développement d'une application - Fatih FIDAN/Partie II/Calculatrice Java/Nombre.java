public class Nombre extends Expression {

	private double valeurNombre;
	
	public Nombre(int nbr) {
		this.valeurNombre = nbr;
	}

	public double valeur() {
		return this.valeurNombre;
	}
	
	public String toString() {
		return "" + this.valeurNombre;
	}
	
}
