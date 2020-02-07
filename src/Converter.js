const years_np  = nsDateConverter.years_np;
const years_en  = nsDateConverter.years_en;
const months_np = nsDateConverter.months_np;
const months_en = nsDateConverter.months_en;
const days_np   = nsDateConverter.days_np;
const days_en   = nsDateConverter.days_en;

class Converter extends React.Component {
	constructor(props) {
	  super(props);
		this.state = {
			mode: '',
			converted_date: '',
			year: '',
			month: '',
			day: '',
			options_year: '',
			options_month: '',
			options_day: '',
			year_field: '',
			month_field: '',
			day_field: '',
			error: '',
		}

	}

	componentDidMount() {
		this.setState({
			mode: 'ennp',
			year: nsDateConverter.today_year,
			month: nsDateConverter.today_month,
			day: nsDateConverter.today_day,
			year_field: nsDateConverter.today_year,
			month_field: nsDateConverter.today_month,
			day_field: nsDateConverter.today_day,
			options_year: years_en,
			options_month: months_en,
			options_day: days_en,
		});
	}

	async onModeChange(e) {
	  this.setState({
	    mode: e.target.value,
	    options_year: ('ennp' === e.target.value ) ? years_en : years_np,
	    options_month: ('ennp' === e.target.value ) ? months_en : months_np,
	    options_day: ('ennp' === e.target.value ) ? days_en : days_np,
	  });

	  if ('ennp' === e.target.value) {
	  	this.setState({
	  		year: nsDateConverter.today_year,
	  		month: nsDateConverter.today_month,
	  		day: nsDateConverter.today_day,
	  		year_field: nsDateConverter.today_year,
	  		month_field: nsDateConverter.today_month,
	  		day_field: nsDateConverter.today_day,
	  	})
	  } else {
		  	let url = `${nsDateConverter.api_url}convert/np?date=${nsDateConverter.today_year}-${this.getPrefixedNumber(nsDateConverter.today_month)}-${this.getPrefixedNumber(nsDateConverter.today_day)}`;
		  	// console.log( url );
		  	const result = await fetch(url).then(function(response) {
		  	   return response.json();
		  	});
		  	// console.log( result );
		  	this.setState({
		  		year: result.year,
		  		month: result.month,
		  		day: result.day,
		  		year_field: result.year,
		  		month_field: result.month,
		  		day_field: result.day,
		  	})
	  }
	};

	onChangeSelectField(e) {
		let change = {}
		change[e.target.name] = e.target.value
		this.setState(change)
	};

	onFormSubmit(e) {
		e.preventDefault();
		const mode = ( 'ennp' === this.state.mode ) ? 'np' :'en';
		// console.log('On Submit');
		let url = `${nsDateConverter.api_url}convert/${mode}?date=${this.state.year_field}-${this.getPrefixedNumber(this.state.month_field)}-${this.getPrefixedNumber(this.state.day_field)}`;
		console.log( url );

	};

	getPrefixedNumber( num ) {
		return String(num).padStart(2, '0')
	}

	render() {
		// console.log( typeof nsDateConverter.months );
		// console.log( months_en );

		return(
			<div>
				<form onSubmit={this.onFormSubmit.bind(this)}>
					<div>
						<label><input type="radio" name="mode" value="npen" checked={this.state.mode === "npen"} onChange={this.onModeChange.bind(this)} />Nepali to English</label>&nbsp;<label><input type="radio" name="mode" value="ennp" checked={this.state.mode === "ennp"} onChange={this.onModeChange.bind(this)} />English to Nepali</label>
					</div>
					<div className="row-date">
						<select name="year_field" value={this.state.year_field} onChange={this.onChangeSelectField.bind(this)}>
							{Object.entries(this.state.options_year).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="month_field" value={this.state.month_field} onChange={this.onChangeSelectField.bind(this)}>
							{Object.entries(this.state.options_month).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="day_field" value={this.state.day_field} onChange={this.onChangeSelectField.bind(this)}>
							{Object.entries(this.state.options_day).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<input type="submit" value="Convert" />
					</div>

					{this.state.error && <div className="converter-error"><p>{this.state.error}</p></div>}

					<div className="date-output">
					<p>
						FROM > {this.state.year} - {this.state.month} - {this.state.day}
					</p>
					<p>
						TO > {JSON.stringify(this.state.converted_date)}
					</p>
					</div>
				</form>
			</div>
		)
	}
}

export default Converter;
