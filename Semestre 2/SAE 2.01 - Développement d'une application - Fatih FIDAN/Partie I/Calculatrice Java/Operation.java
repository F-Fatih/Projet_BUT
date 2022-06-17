public abstract class Operation {

	private Nombre operande_1;
	private Nombre operande_2;
	
	public Operation(Nombre nbr_1, Nombre nbr_2) {
		this.operande_1 = nbr_1;
		this.operande_2 = nbr_2;
	}
	
	public abstract int valeur();	
	public Nombre getOPerande1() {return this.operande_1;}
	public Nombre getOPerande2() {return this.operande_2;}
	
	
	//La méthode valeur ci-dessous nous a permis de tester la class Operation sans qu'il soit abstrait
	/*public int valeur() {
		return 0;
	}*/

}
