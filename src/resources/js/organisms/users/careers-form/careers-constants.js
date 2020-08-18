export const careerDefaultValue = {
  gymName: '',
  startAt: '',
  endAt: '',
  inOffice: false,
  description: ''
}

export const validateDate = (value) => {
  if (!value) {
    return null
  }
  if (!/[0-9]{4}\/[0-9]{2}/.test(value)) {
    return 'YYYY/MMの形式で年月を入力してください'
  }
  const year = value.slice(0, 4)
  const month = value.slice(5, 7)
  const now = new Date()
  if (parseInt(year) < now.getFullYear()) {
    return null
  }

  const isPast = parseInt(year) === now.getFullYear()
    && parseInt(month) <= now.getMonth() + 1
  if (isPast) {
    return null
  }

  return '過去の日付を入力してください'
}

export const validateCareer = (career) => {
  const defaultJsonCareer = JSON.stringify(careerDefaultValue)
  if (defaultJsonCareer === JSON.stringify(career)) {
    return true
  }

  if (!career.gymName || !career.description) {
    return false
  }

  if (career.endAt && career.inOffice) {
    return false
  }

  if (career.startAt && career.inOffice) {
    return !validateDate(career.startAt)
  }

  if (career.startAt && career.endAt) {
    return !validateDate(career.startAt)
      && !validateDate(career.endAt)
  }

  return false
}

export const stringifyCareers = (careers) => {
  const formatted = careers.map(career => {
    return {
      gym_name: career.gymName,
      start_at: career.startAt,
      end_at: career.endAt,
      in_office: Boolean(career.inOffice),
      description: career.description
    }
  })
  return JSON.stringify(formatted)
}

export const parseCareers = (careersValue) => {
  const careers = JSON.parse(careersValue)
  return careers.map(career => {
    return {
      gymName: career.gym_name,
      startAt: career.start_at,
      endAt: career.end_at,
      inOffice: Boolean(career.in_office),
      description: career.description
    }
  })
}
