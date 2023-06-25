const nsdcGetOptions = ( items = {} ) => {
	const output = [];

	for ( const [ key, value ] of Object.entries( items ) ) {
		output.push( { value: key, label: value } );
	}

	return output;
};

export { nsdcGetOptions };
