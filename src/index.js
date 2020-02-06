import Converter from './Converter';

const { render, useState } = wp.element;

const NsDateConverter = () => {

	const getDate = async (event) => {
		let url = nsDateConverter.api_url + 'convert/en?date=2076-10-23';
		const result = await fetch(url).then(function(response) {
			return response.json();
		});
	   console.log( result );

	}

	return (
		<div>
			<h3>NS Date Converter</h3>
			<Converter />
		</div>
		);
}


render(<NsDateConverter />, document.getElementById('ns-date-converter-app'));
