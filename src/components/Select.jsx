const Select = ( { id, name, label, value, options, onChange } ) => {
	return (
		<label htmlFor={ id }>
			{ label }
			<select
				id={ id }
				name={ name }
				value={ value }
				onChange={ onChange }
			>
				{ options.map( ( option ) => (
					<option key={ option.value } value={ option.value }>
						{ option.label }
					</option>
				) ) }
			</select>
		</label>
	);
};

export default Select;
