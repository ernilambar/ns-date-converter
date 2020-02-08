import Converter from './Converter';

const { render, useState } = wp.element;

const NsDateConverter = () => {

	return (
		<div>
			<Converter />
		</div>
		);
}


render(<NsDateConverter />, document.getElementById('ns-date-converter-app'));
