import './Result.scss';

const Result = ( { success, nepali, english, errorMessage, onClickBack } ) => {
	return (
		<div className="nsdc-result">
			<div className="nsdc-result-buttons">
				<button onClick={ onClickBack }>Back</button>
			</div>
			{ success && (
				<div className="nsdc-billboard">
					<div className="nsdc-billboard-box">
						<span>
							<strong>Nepali (BS):</strong>
						</span>
						<div>{ nepali }</div>
					</div>
					<div
						className="nsdc-billboard-box"
						style={ { marginTop: '10px' } }
					>
						<span>
							<strong>English (AD):</strong>
						</span>
						<div>{ english }</div>
					</div>
				</div>
			) }
			{ ! success && (
				<div className="nsdc-errorboard">{ errorMessage }</div>
			) }
		</div>
	);
};

export default Result;
