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
			year: '',
			month: '',
			day: '',
			options_year: '',
			options_month: '',
			options_day: '',
		}

	}

	componentDidMount() {
		this.setState({
			mode: 'ennp',
			year: nsDateConverter.today_year,
			month: nsDateConverter.today_month,
			day: nsDateConverter.today_day,
			options_year: years_en,
			options_month: months_en,
			options_day: days_en,
		});
	}

	onModeChange(e) {
	  this.setState({
	    mode: e.target.value,
	    options_year: ('ennp' === e.target.value ) ? years_en : years_np,
	    options_month: ('ennp' === e.target.value ) ? months_en : months_np,
	    options_day: ('ennp' === e.target.value ) ? days_en : days_np,
	  });
	};

	onChangeYear(e) {
	};

	render() {
		// console.log( typeof nsDateConverter.months );
		// console.log( months_en );

		return(
			<div>
				<form>
					<div>
						<input type="radio" name="mode" value="npen" checked={this.state.mode === "npen"} onChange={this.onModeChange.bind(this)} />Nepali to English&nbsp;<input type="radio" name="mode" value="ennp" checked={this.state.mode === "ennp"} onChange={this.onModeChange.bind(this)} />English to Nepali
					</div>
					<div className="row-date">
						<select name="year_np" value={this.state.year} onChange={this.onChangeYear}>
							{Object.entries(this.state.options_year).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="month_np" value={this.state.month} onChange={this.onChangeYear}>
							{Object.entries(this.state.options_month).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="day_np" value={this.state.day} onChange={this.onChangeYear}>
							{Object.entries(this.state.options_day).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
					</div>
				</form>
			</div>
		)
	}
}

export default Converter;
