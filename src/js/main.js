// Limit input value to a range of numbers (min, max) or completely empty
const limitInputValue = (inputElem, minValue, maxValue) => {
    $(inputElem).on('input', function () {
        let value = $(this).val()
        if (value < minValue || value > maxValue) {
            $(this).val('')
        }
    })
}

// Calculate total score
const calculateTotalScore = () => {
    let totalScore = 0
    const inputs = document.querySelectorAll('input')
    inputs.forEach((input) => {
        if (input.value !== '') {
            totalScore += parseInt(input.value)
        }
    })
    return totalScore
}

// If both inputs are empty, both inputs should be enabled
// If one of the inputs contains a value, the other input will be disabled
// If user deletes the value from the input, the other input will be enabled
// Add or subtract input value to total score when input value changes
const disableInput = (inputElem, otherInputElem) => {
    $(inputElem).on('input', function () {
        let value = $(this).val()
        if (value === '') {
            $(otherInputElem).prop('disabled', false)
            $(otherInputElem).css('cursor', 'text')
        } else {
            $(otherInputElem).prop('disabled', true)
            // Set cursor to not allowed if input is disabled
            $(otherInputElem).css('cursor', 'not-allowed')
        }
    })

    $(otherInputElem).on('input', function () {
        let value = $(this).val()
        if (value === '') {
            $(inputElem).prop('disabled', false)
            $(inputElem).css('cursor', 'text')
        } else {
            $(inputElem).prop('disabled', true)
            // Set cursor to not allowed if input is disabled
            $(inputElem).css('cursor', 'not-allowed')
        }
    })
}

$(document).ready(function () {
    const articulateRequirementsDeveloping = $(
        '#articulateRequirementsDeveloping'
    )
    const articulateRequirementsAccomplished = $(
        '#articulateRequirementsAccomplished'
    )
    const chooseAppropriateToolsDeveloping = $(
        '#chooseAppropriateToolsDeveloping'
    )
    const chooseAppropriateToolsAccomplished = $(
        '#chooseAppropriateToolsAccomplished'
    )
    const giveClearAndCoherentOralPresentationDeveloping = $(
        '#giveClearAndCoherentOralPresentationDeveloping'
    )
    const giveClearAndCoherentOralPresentationAccomplished = $(
        '#giveClearAndCoherentOralPresentationAccomplished'
    )
    const functionedWellAsATeamDeveloping = $('#functionedWellAsATeamDeveloping')
    const functionedWellAsATeamAccomplished = $(
        '#functionedWellAsATeamAccomplished'
    )

    // Limit input value to a range of numbers (min, max) or completely empty
    limitInputValue(articulateRequirementsDeveloping, 0, 10)
    limitInputValue(articulateRequirementsAccomplished, 10, 15)
    limitInputValue(chooseAppropriateToolsDeveloping, 0, 10)
    limitInputValue(chooseAppropriateToolsAccomplished, 10, 15)
    limitInputValue(giveClearAndCoherentOralPresentationDeveloping, 0, 10)
    limitInputValue(giveClearAndCoherentOralPresentationAccomplished, 10, 15)
    limitInputValue(functionedWellAsATeamDeveloping, 0, 10)
    limitInputValue(functionedWellAsATeamAccomplished, 10, 15)

    // If both inputs are empty, both inputs should be enabled
    // If one of the inputs contains a value, the other input will be disabled
    disableInput(
        articulateRequirementsDeveloping,
        articulateRequirementsAccomplished
    )
    disableInput(
        chooseAppropriateToolsDeveloping,
        chooseAppropriateToolsAccomplished
    )
    disableInput(
        giveClearAndCoherentOralPresentationDeveloping,
        giveClearAndCoherentOralPresentationAccomplished
    )
    disableInput(
        functionedWellAsATeamDeveloping,
        functionedWellAsATeamAccomplished
    )

    // On any input change, calculate total score
    $('input').on('input', function () {
        let totalScore = calculateTotalScore()
        $('#totalScore').text(totalScore)
    })
})
