import React from 'react';
import { Spinno } from 'spinno';
import Button from './components/Button';
import { nsdcGetOptions } from './helpers/utils';
import Select from './components/Select';
import Result from './components/Result';

import './App.scss';

class App extends React.Component {
	constructor( props ) {
		super( props );

		this.state = {
			npYear: '',
			npMonth: '',
			npDay: '',
			enYear: '',
			enMonth: '',
			enDay: '',
			loading: false,
			resultOpen: false,
			resultSuccess: false,
			errorboardOpen: false,
			errorMessage: '',
			resultNepali: '',
			resultEnglish: '',
		};
	}

	componentDidMount() {
		const { year: npYear, month: npMonth, day: npDay } = NSDC_APP.today.np;

		const { year: enYear, month: enMonth, day: enDay } = NSDC_APP.today.en;

		this.setState( {
			npYear,
			npMonth,
			npDay,
			enYear,
			enMonth,
			enDay,
		} );
	}

	convertDate = ( to ) => {
		this.setState( { loading: true } );

		const data = new FormData();

		data.append( 'action', NSDC_APP.date_action );
		data.append( 'to', to );

		if ( 'np' === to ) {
			data.append( 'year', this.state.enYear );
			data.append( 'month', this.state.enMonth );
			data.append( 'day', this.state.enDay );
		} else if ( 'en' === to ) {
			data.append( 'year', this.state.npYear );
			data.append( 'month', this.state.npMonth );
			data.append( 'day', this.state.npDay );
		}

		fetch( NSDC_APP.ajax_url, {
			method: 'POST',
			credentials: 'same-origin',
			body: data,
		} )
			.then( ( response ) => response.json() )
			.then( ( resp ) => {
				if ( true === resp.success ) {
					const dateInfo = resp.data;

					this.setState( {
						loading: false,
						resultOpen: true,
						resultSuccess: true,
						resultNepali: dateInfo.np.formatted,
						resultEnglish: dateInfo.en.formatted,
						errorboardOpen: false,
					} );
				} else {
					this.setState( {
						loading: false,
						resultOpen: true,
						resultSuccess: false,
						errorMessage: 'Error',
					} );
				}
			} );
	};

	handleCustomSelectDropdown = ( e ) => {
		this.setState( { [ e.target.id ]: e.target.value } );
	};

	handleSubmitConvertToEnglish = () => {
		this.convertDate( 'en' );
	};

	handleSubmitConvertToNepali = () => {
		this.convertDate( 'np' );
	};

	onClickBack = ( e ) => {
		e.preventDefault();

		this.setState( {
			resultOpen: false,
		} );
	};

	render() {
		return (
			<div className="nsdc-app">
				{ ! this.state.resultOpen && (
					<div className="nsdc-form">
						<div className="nsdc-row">
							<div className="nsdc-inputs">
								<div className="nsdc-input">
									<Select
										id="npYear"
										label="Year"
										value={ this.state.npYear }
										onChange={
											this.handleCustomSelectDropdown
										}
										options={ nsdcGetOptions(
											NSDC_APP.years_np
										) }
									/>
								</div>
								<div className="nsdc-input">
									<Select
										id="npMonth"
										label="Month"
										value={ this.state.npMonth }
										onChange={
											this.handleCustomSelectDropdown
										}
										options={ nsdcGetOptions(
											NSDC_APP.months_np
										) }
									/>
								</div>
								<div className="nsdc-input">
									<Select
										id="npDay"
										label="Day"
										value={ this.state.npDay }
										onChange={
											this.handleCustomSelectDropdown
										}
										options={ nsdcGetOptions(
											NSDC_APP.days_np
										) }
									/>
								</div>
								<div className="nsdc-input">
									<Button
										className="button"
										onClick={
											this.handleSubmitConvertToEnglish
										}
									>
										Convert to English
									</Button>
								</div>
							</div>
						</div>
						<div className="nsdc-row">
							<div className="nsdc-inputs">
								<div className="nsdc-input">
									<Select
										id="enYear"
										label="Year"
										value={ this.state.enYear }
										onChange={
											this.handleCustomSelectDropdown
										}
										options={ nsdcGetOptions(
											NSDC_APP.years_en
										) }
									/>
								</div>
								<div className="nsdc-input">
									<Select
										id="enMonth"
										label="Month"
										value={ this.state.enMonth }
										onChange={
											this.handleCustomSelectDropdown
										}
										options={ nsdcGetOptions(
											NSDC_APP.months_en
										) }
									/>
								</div>
								<div className="nsdc-input">
									<Select
										id="enDay"
										label="Day"
										value={ this.state.enDay }
										onChange={
											this.handleCustomSelectDropdown
										}
										options={ nsdcGetOptions(
											NSDC_APP.days_en
										) }
									/>
								</div>
								<div className="nsdc-input">
									<Button
										className="button"
										onClick={
											this.handleSubmitConvertToNepali
										}
									>
										Convert to Nepali
									</Button>
								</div>
							</div>
						</div>
					</div>
				) }
				{ this.state.loading && <Spinno /> }
				{ this.state.resultOpen && (
					<Result
						success={ this.state.resultSuccess }
						nepali={ this.state.resultNepali }
						english={ this.state.resultEnglish }
						errorMessage={ this.state.errorMessage }
						onClickBack={ this.onClickBack }
					/>
				) }
			</div>
		);
	}
}

export default App;
