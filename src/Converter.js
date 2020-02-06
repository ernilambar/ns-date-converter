
class Converter extends React.Component {
	constructor(props) {
	  super(props);
		this.state = {
			mode: 'npen'
		}
	}

	onModeChange(e) {
	  this.setState({
	    mode: e.target.value
	  });
	};


	render() {
		return(
			<div>
			<form>
			<input type="radio" name="mode" value="npen" checked={this.state.mode === "npen"} onChange={this.onModeChange.bind(this)} />Nepali to English<br />
			<input type="radio" name="mode" value="ennp" checked={this.state.mode === "ennp"} onChange={this.onModeChange.bind(this)} />English to Nepali
			</form>
			</div>
		)
	}
}

export default Converter;
