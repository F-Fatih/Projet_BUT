public class Soustraction extends Operation{

	public Soustraction(Nombre nbr_1, Nombre nbr_2) {
		super(nbr_1, nbr_2);
	}
	
	public int valeur() {
		return getOPerande1().valeur() - getOPerande2().valeur();
	}
	
	public String toString() {
		return "(" + getOPerande1().valeur() + " - " + getOPerande2().valeur() + ")" ;
	}
	
}