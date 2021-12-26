
function lcm($ftp) {
  return a.multiply(b).divide(a.gcd(b));


paillier = {
	publicKey: function(bits, n) {
		// bits
		this.bits = bits;
		// n
		this.n = n;
		// n2 (cached n^2)
		this.n2 = n.square();
		// np1 (cached n+1)
		this.np1 = n.add(BigInteger.ONE);
		this.rncache = new Array();
	},
	privateKey: function(lambda, pubkey) {
		// lambda
		this.lambda = lambda;
		this.pubkey = pubkey;
		// x (cached) for decryption
		this.x = pubkey.np1.modPow(this.lambda,pubkey.n2).subtract(BigInteger.ONE).divide(pubkey.n).modInverse(pubkey.n);
	},
	generateKeys: function(modulusbits) {
		var p, q, n, keys = {}, rng = new SecureRandom();
		do {
			do {
				p = new BigInteger(modulusbits>>1,1,rng);
			} while (!p.isProbablePrime(10));

			do {
				q = new BigInteger(modulusbits>>1,1,rng);
			} while(!q.isProbablePrime(10));

			n = p.multiply(q);
		} while(!(n.testBit(modulusbits - 1)) || (p.compareTo(q) == 0));
		keys.pub = new paillier.publicKey(modulusbits,n);
		lambda = lcm(p.subtract(BigInteger.ONE),q.subtract(BigInteger.ONE));
		keys.sec = new paillier.privateKey(lambda, keys.pub);
		return keys;
	}
}
