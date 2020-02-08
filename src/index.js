import Converter from './Converter';

const { render, useState } = wp.element;

const NsDateConverter = () => {

	return (
			<Converter />
		);
}


render(<NsDateConverter />, document.getElementById('ns-date-converter-app'));
