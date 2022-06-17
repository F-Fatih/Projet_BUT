public abstract class Operation extends Expression {

	private Expression operande_1;
	private Expression operande_2;
	
	public Operation(Expression nbr_1, Expression nbr_2) {
		this.operande_1 = nbr_1;
		this.operande_2 = nbr_2;
	}
	
	public abstract double valeur();
	
	/* Cette ligne de code nous a permis de tester la class 'Operation' qui herite de 'Expression'
	public double valeur() {
		return 0;
	}
	*/
	
	public Expression getOPerande1() {return this.operande_1;}
	public Expression getOPerande2() {return this.operande_2;}
	
}
