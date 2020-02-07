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
			mode: ''
		}

	}

	componentDidMount() {
		this.setState({
			mode: 'npen'
		});
	}

	onModeChange(e) {
	  this.setState({
	    mode: item.target.value
	  });
	};


	render() {
		// console.log( typeof nsDateConverter.months );
		// console.log( months_en );

		return(
			<div>
				<form>
					<div>
					<input type="radio" name="mode" value="npen" checked={this.state.mode === "npen"} onChange={this.onModeChange.bind(this)} />Nepali to English<br />
					<input type="radio" name="mode" value="ennp" checked={this.state.mode === "ennp"} onChange={this.onModeChange.bind(this)} />English to Nepali
					</div>
					<div className="row-nepali">
						<select name="year_np">
							{Object.entries(years_np).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="month_np">
							{Object.entries(months_np).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="day_np">
							{Object.entries(days_np).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
					</div>
					<div className="row-english">
						<select name="year_en">
							{Object.entries(years_en).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="month_en">
							{Object.entries(months_en).map((item, key) => {
						        return <option key={item[1]} value={item[0]}>{item[1]}</option>;
						    })}
						</select>
						<select name="day_en">
							{Object.entries(days_en).map((item, key) => {
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
