public class Nombre {

	private int valeurNombre;
	
	public Nombre(int nbr) {
		this.valeurNombre = nbr;
	}

	public int valeur() {
		return this.valeurNombre;
	}
	
	public String toString() {
		return "Le nombre choisi est : " + this.valeurNombre;
	}
	
}
